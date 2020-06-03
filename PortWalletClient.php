<?php

namespace PortWallet\SDK;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PortWalletClient
{
    /**
     * Contains configurations for PortWallet API
     *
     * @var $config
     */
    private $config;

    /**
     * API base url
     *
     * @var $baseUrl
     */
    private $baseUrl;

    /**
     * Holds authorization token
     *
     * @var $authorization
     */
    private $authorization;

    /**
     * Holds Symfony HttpClient instance
     *
     * @var \Symfony\Contracts\HttpClient\HttpClientInterface
     */
    protected $client;

    /**
     * PortWalletClient constructor.
     *
     * Setup all configurations and base url
     */
    public function __construct()
    {
        $this->setConfig();
        $this->setBaseUrl();
        $this->setAuthorization();

        if (empty($this->config['app_key']) || empty($this->config['app_secret'])) {
            new \Exception('App key or secret key is missing.');
        }

        $this->client = HttpClient::create();
    }

    /**
     * Set configurations
     */
    private function setConfig(): void
    {
        $this->config = include "config.php";
    }

    /**
     * Set base url
     */
    public function setBaseUrl(): void
    {
        if ($this->config['mode'] == 'sandbox') {
            $this->baseUrl = $this->config['sandbox_endpoint'];
        } else {
            $this->baseUrl = $this->config['live_endpoint'];
        }
    }

    /**
     * @return void
     */
    private function setAuthorization(): void
    {
        $this->authorization = "Bearer " . base64_encode($this->config['app_key']
                . ":"
                . md5($this->config['app_secret'] . time()));
    }

    /**
     * Make complete url
     *
     * @param string $url
     * @return string
     */
    private function make(string $url): string
    {
        return trim($this->baseUrl, '/') . '/' . trim($url, '/');
    }

    /**
     * Post data to API
     *
     * @param string $url
     * @param $data
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function post(string $url, $data): array
    {
        $url = $this->make($url);

        $response = $this->client->request('POST', $url, [
            'headers' => [
                'Authorization' => $this->authorization,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($data)
        ]);

        return [
            'http_code' => $response->getStatusCode(),
            'content' => json_decode($response->getContent())
        ];
    }

    /**
     * Retrieve data from API
     *
     * @param string $url
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function get(string $url): array
    {
        $url = $this->make($url);

        $response = $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->authorization
            ]
        ]);

        return [
            'http_code' => $response->getStatusCode(),
            'content' => json_decode($response->getContent())
        ];
    }
}
