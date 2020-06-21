<?php

namespace PortWallet\Services;


use PortWallet\Invoice;
use PortWallet\Recurring;
use PortWallet\Exceptions\PortWalletClientException;
use PortWallet\Traits\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RecurringService extends AbstractService
{
    use Response;

    /**
     * Create a new recurring
     *
     * @param array $data
     * @return Invoice
     * @throws PortWalletClientException
     */
    public function create(array $data): Invoice
    {
        $url = '/recurring';
        $response = $this->client->request('POST', $url, [], $data);
        $content = $this->getContent($response);

        return new Invoice($content);
    }

    /**
     * Get recurring
     *
     * @param string $invoiceId
     * @return Recurring
     * @throws PortWalletClientException
     */
    public function retrieve(string $invoiceId)
    {
        $url = '/recurring/' . 'R' . $invoiceId;
        $response = $this->client->request('GET', $url);
        $content = $this->getContent($response);

        return new Recurring($content);
    }

    /**
     * Cancel recurring
     *
     * @param string $invoiceId
     * @param array $data
     * @return ResponseInterface
     */
    public function cancel(string $invoiceId, array $data): ResponseInterface
    {
        $url = '/recurring/cancel/' . 'R' . $invoiceId;
        return $this->client->request('PUT', $url, $data);
    }
}
