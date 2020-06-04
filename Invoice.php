<?php

namespace PortWallet\SDK;


use Symfony\Contracts\HttpClient\Exception\{
    ClientExceptionInterface, RedirectionExceptionInterface, ServerExceptionInterface, TransportExceptionInterface
};
use PortWallet\SDK\Traits\Validator;

class Invoice
{
    use Validator;

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
        $data = json_decode(json_encode($data));
        $validator = $this->validate($data, "invoice");

        if (!$validator->isValid()) {
            $errors = $this->commonError($validator->getErrors());

            return [
                'http_code' => 422,
                'content' => $errors
            ];
        }

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
