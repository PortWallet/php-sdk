<?php

namespace PortWallet\Services;


use PortWallet\Exceptions\PortWalletClientException;
use PortWallet\Invoice;
use PortWallet\Traits\Response;
use PortWallet\Traits\Validator;
use Symfony\Contracts\HttpClient\ResponseInterface;

class InvoiceService extends AbstractService
{
    use Validator, Response;

    /**
     * Create new invoice
     *
     * @param array $data
     * @return Invoice
     * @throws PortWalletClientException
     */
    public function create(array $data = []): Invoice
    {
        $this->validate($data, "invoice");

        $url = 'invoice';
        $response = $this->client->request('POST', $url, [], ['body' => $data]);
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
     * @return ResponseInterface
     * @throws PortWalletClientException
     */
    public function makeRefundRequest(string $invoiceId, array $data): ResponseInterface
    {
        $this->validate($data, "refund");

        $url = '/invoice/refund/' . $invoiceId;
        return $this->client->request('POST', $url, ['body' => $data]);
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
