<?php

namespace PortWallet\SDK;


use Symfony\Contracts\HttpClient\Exception\{
    ClientExceptionInterface, RedirectionExceptionInterface, ServerExceptionInterface, TransportExceptionInterface
};
use PortWallet\SDK\Traits\Validator;

class Recurring
{
    use Validator;

    /**
     * PortWallet HttpClient
     *
     * @var PortWalletClient
     */
    protected $client;

    /**
     * Recurring constructor.
     */
    public function __construct()
    {
        $this->client = new PortWalletClient();
    }

    /**
     * Create a new recurring
     *
     * @param array $data
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function create(array $data): array
    {
        $data = json_decode(json_encode($data));
        $validator = $this->validate($data, 'recurring');

        if (!$validator->isValid()) {
            $errors = $this->commonError($validator->getErrors());

            return [
                'http_code' => 422,
                'content' => $errors
            ];
        }

        $url = '/recurring';
        return $this->client->post($url, $data);
    }
}
