<?php

namespace PortWallet\Services;


use PortWallet\Exceptions\PortWalletClientException;
use PortWallet\Invoice;
use PortWallet\Response;
use PortWallet\Traits\ResponseTrait;

class InvoiceService extends AbstractService
{
    use ResponseTrait;

    /**
     * Create new invoice
     *
     * @param array $data
     * @return Invoice
     * @throws PortWalletClientException
     */
    public function create(array $data): Invoice
    {
        $url = 'invoice';
        $response = $this->client->request('POST', $url, [], $data);
        $content = $this->getContent($response);

        return $this->makeInvoice($content);
    }

    /**
     * Retrieve an existing invoice
     *
     * @param string $invoiceId
     * @return Invoice
     * @throws PortWalletClientException
     */
    public function retrieve(string $invoiceId): Invoice
    {
        $url = 'invoice/' . $invoiceId;
        $response = $this->client->request('GET', $url);
        $content = $this->getContent($response);

        return $this->makeInvoice($content);
    }

    /**
     * Validate IPN
     *
     * @param string $invoiceId
     * @param float $amount
     * @return Invoice
     * @throws PortWalletClientException
     */
    public function ipnValidate(string $invoiceId, float $amount): Invoice
    {
        $url = 'invoice/ipn/' . $invoiceId . '/' . $amount;
        $response = $this->client->request('GET', $url);
        $content = $this->getContent($response);

        return $this->makeInvoice($content);
    }

    /**
     * Make a refund request
     *
     * @param string $invoiceId
     * @param array $data
     * @return Response
     * @throws PortWalletClientException
     */
    public function makeRefundRequest(string $invoiceId, array $data): Response
    {
        $url = '/invoice/refund/' . $invoiceId;
        $response = $this->client->request('POST', $url, [], $data);
        $content = $this->getContent($response);

        return new Response($content);
    }

    /**
     * Generate an invoice object
     *
     * @param object $content
     * @return Invoice
     */
    private function makeInvoice(object $content): Invoice
    {
        return new Invoice($content);
    }
}
