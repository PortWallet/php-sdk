<?php


namespace PortWallet\SDK\Services;


use PortWallet\SDK\PortWalletClient;

class Service
{
    /**
     * PostWallet HttpClient
     *
     * @var PortWalletClient
     */
    protected $client;

    public function __construct()
    {
        $this->client = new PortWalletClient();

        return $this->client;
    }
}
