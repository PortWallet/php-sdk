<?php

namespace PortWallet\SDK;


class Invoice
{
    private $client;

    /**
     * Invoice constructor.
     */
    public function __construct()
    {
        // Call to PortWalletClient
        $this->client = new PortWalletClient();
        $this->client->process();

        return $this->client;
    }

    public function create(array $data = [])
    {
        // Create invoice and return response
        $this->client->request($data);
    }

    public function createWithDiscount(array $data)
    {
        // Create invoice with discount
        $this->client->request([]);
    }

    public function createWithEmi(array $data)
    {
        // Create with EMI
        $this->client->request([]);
    }

    public function retrieve(string $invoiceId)
    {
        // Retrieve invoice
        $this->client->request([]);
    }

    public function ipnValidate(string $invoiceId, float $amount)
    {
        // Validate IPN
        $this->client->ipnValidate($invoiceId, $amount);
    }

    public function makeRefundRequest(string $invoiceId, array $data)
    {
        // Make a refund request
    }
}
