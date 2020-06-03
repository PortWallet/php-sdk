<?php

namespace PortWallet\SDK;


use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Recurring
{
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
        $url = '/recurring';
        return $this->client->post($url, $data);
    }
}
