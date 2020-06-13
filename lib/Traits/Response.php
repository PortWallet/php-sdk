<?php


namespace PortWallet\Traits;


use Symfony\Contracts\HttpClient\Exception\{
    ClientExceptionInterface, RedirectionExceptionInterface, ServerExceptionInterface, TransportExceptionInterface
};
use PortWallet\Exceptions\PortWalletClientException;
use Symfony\Contracts\HttpClient\ResponseInterface;

trait Response
{
    /**
     * @param ResponseInterface $response
     * @return object
     * @throws PortWalletClientException
     */
    public function getContent(ResponseInterface $response): object
    {
        try {
            return json_decode($response->getContent());
        } catch (ClientExceptionInterface $e) {
            throw new PortWalletClientException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (RedirectionExceptionInterface $e) {
            throw new PortWalletClientException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (ServerExceptionInterface $e) {
            throw new PortWalletClientException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (TransportExceptionInterface $e) {
            throw new PortWalletClientException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}
