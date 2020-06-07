<?php

namespace PortWallet\SDK\Services;


use PortWallet\SDK\Invoice;
use PortWallet\SDK\Recurring;
use PortWallet\SDK\Exceptions\PortWalletClientException;
use PortWallet\SDK\Traits\Response;
use PortWallet\SDK\Traits\Validator;

class RecurringService extends Service
{
    use Validator, Response;

    /**
     * Recurring constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create a new recurring
     *
     * @param array $data
     * @return Invoice
     * @throws PortWalletClientException
     */
    public function create(array $data): Invoice
    {
        $data = json_decode(json_encode($data));
        $this->validate($data, 'recurring');

        $url = '/recurring';
        $response = $this->client->request('POST', $url, $data);
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
    public function retrieve(string $invoiceId): Recurring
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
     * @return object
     * @throws PortWalletClientException
     */
    public function cancel(string $invoiceId, array $data)
    {
        $data = json_decode(json_encode($data));
        $url = '/recurring/cancel/' . 'R' . $invoiceId;
        $response = $this->client->request('PUT', $url, $data);

        return $this->getContent($response);
    }
}
