<?php

namespace PortWallet\SDK;


use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Invoice
{
    /**
     * PostWallet HttpClient
     *
     * @var PortWalletClient
     */
    private $client;

    /**
     * Invoice constructor.
     */
    public function __construct()
    {
        $this->client = new PortWalletClient();

        return $this->client;
    }

    /**
     * Create new invoice
     *
     * @param array $data
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function create(array $data = []): array
    {
        $url = 'invoice';
        return $this->client->post($url, $data);
    }

    /**
     * Retrieve an existing invoice
     *
     * @param string $invoiceId
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function retrieve(string $invoiceId): array
    {
        $url = 'invoice/' . $invoiceId;
        return $this->client->get($url);
    }

    /**
     * Validate IPN
     *
     * @param string $invoiceId
     * @param float $amount
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function ipnValidate(string $invoiceId, float $amount): array
    {
        $url = 'invoice/ipn/' . $invoiceId . '/' . $amount;
        return $this->client->get($url);
    }

    /**
     * Make a refund request
     *
     * @param string $invoiceId
     * @param array $data
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function makeRefundRequest(string $invoiceId, array $data)
    {
        $url = '/invoice/refund/' . $invoiceId;
        return $this->client->post($url, $data);
    }
}
