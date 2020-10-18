<?php


namespace PortWallet\Traits;


use Symfony\Contracts\HttpClient\Exception\{
    ClientExceptionInterface, RedirectionExceptionInterface, ServerExceptionInterface, TransportExceptionInterface
};
use PortWallet\Exceptions\BadRequestException;
use PortWallet\Exceptions\InternalServiceException;
use PortWallet\Exceptions\NotFoundException;
use PortWallet\Exceptions\PortWalletClientException;
use PortWallet\Exceptions\UnauthorizedException;
use Symfony\Contracts\HttpClient\ResponseInterface;

trait ResponseTrait
{
    /**
     * @param ResponseInterface $response
     * @return object
     * @throws PortWalletClientException
     * @throws BadRequestException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws InternalServiceException
     */
    public function getContent(ResponseInterface $response): object
    {
        try {
            $content = json_decode($response->getContent(false));

            if (strtolower($content->result) !== 'success') {
                switch ($response->getStatusCode()) {
                    case 400:
                        throw new BadRequestException($content->error->explanation, 400);
                    case 401:
                        throw new UnauthorizedException($content->error->explanation, 401);
                    case 403:
                        throw new UnauthorizedException($content->error->explanation, 403);
                    case 404:
                        throw new NotFoundException($content->error->explanation, 404);
                    default:
                        throw new InternalServiceException($content->error->explanation, 500);
                }
            }
            return $content;

        } catch (
            ClientExceptionInterface
            | RedirectionExceptionInterface
            | ServerExceptionInterface
            | TransportExceptionInterface $e
        ) {
            $message = $e->getMessage() . ' Please check your internet connection.';

            throw new PortWalletClientException(
                $message, $e->getCode(), $e->getPrevious()
            );
        }
    }
}
