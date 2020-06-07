<?php

namespace PortWallet\SDK;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

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
     * @var HttpClientInterface
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
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function post(string $url, $data): ResponseInterface
    {
        $url = $this->make($url);

        return $this->client->request('POST', $url, [
            'headers' => [
                'Authorization' => $this->authorization,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($data)
        ]);
    }

    /**
     * Retrieve data from API
     *
     * @param string $url
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function get(string $url): ResponseInterface
    {
        $url = $this->make($url);

        return $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->authorization
            ]
        ]);
    }

    public function request(string $method, string $url, array $data = []): ResponseInterface
    {
        $url = $this->make($url);
        $method = strtoupper($method);
        $headers = [];

        $headers['Authorization'] = $this->authorization;

        if ($method == 'GET') {
            $options = [
                'headers' => $headers
            ];
        } else {
            $headers['Content-Type'] = 'application/json';
            $options = [
                'headers' => $headers,
                'body' => json_encode($data)
            ];
        }

        return $this->client->request($method, $url, $options);
    }
}
