<?php

namespace PortWallet\SDK\Services;


use PortWallet\SDK\Invoice;
use PortWallet\SDK\Exceptions\PortWalletClientException;
use PortWallet\SDK\Traits\Response;
use PortWallet\SDK\Traits\Validator;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class InvoiceService extends Service
{
    use Validator, Response;

    /**
     * Invoice constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create new invoice
     *
     * @param array $data
     * @return Invoice
     * @throws PortWalletClientException|TransportExceptionInterface
     */
    public function create(array $data = []): Invoice
    {
        $this->validate($data, "invoice");

        $url = 'invoice';
        $response = $this->client->request('POST', $url, $data);
        $content = $this->getContent($response);

        return $this->makeInvoice($content);
    }

    /**
     * Retrieve an existing invoice
     *
     * @param string $invoiceId
     * @return Invoice
     * @throws PortWalletClientException|TransportExceptionInterface
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
     * @throws PortWalletClientException|TransportExceptionInterface
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
     * @return ResponseInterface
     * @throws PortWalletClientException
     * @throws TransportExceptionInterface
     */
    public function makeRefundRequest(string $invoiceId, array $data): ResponseInterface
    {
        $this->validate($data, "refund");

        $url = '/invoice/refund/' . $invoiceId;
        return $this->client->request('POST', $url, $data);
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
