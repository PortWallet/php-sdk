<?php

namespace PortWallet;

use PortWallet\Exceptions\InvalidArgumentException;
use PortWallet\Exceptions\PortWalletClientException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class BasePortWalletClient implements PortWalletClientInterface
{
    /**
     * Holds all the configurations for PortWallet API
     *
     * @var array
     */
    private $config = [];

    /**
     * Holds Symfony HttpClient instance
     *
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * BasePortWalletClient constructor.
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(string $apiKey, string $apiSecret)
    {
        if (empty($apiKey) || empty($apiSecret)) {
            throw new InvalidArgumentException('The api key or secret is empty.');
        }

        $config['api_key'] = $apiKey;
        $config['api_secret'] = $apiSecret;

        $config = \array_merge($this->getDefaultConfig(), $config);
        $this->validateConfig($config);

        $this->config = $config;
    }

    /**
     * Gets the API key used by the client to send requests.
     *
     * @return null|string the API key used by the client to send requests
     */
    public function getApiKey(): string
    {
        return $this->config['api_key'];
    }

    /**
     * Gets the API secret used by the client to send requests.
     *
     * @return null|string the API secret used by the client to send requests
     */
    public function getApiSecret(): string
    {
        return $this->config['api_secret'];
    }

    /**
     * Gets the API base live used by the client to send requests.
     *
     * @return null|string the API base live used by the client to send requests
     */
    public function getApiBaseLive(): string
    {
        return $this->config['api_base_live'];
    }

    /**
     * Gets the API base sandbox used by the client to send requests.
     *
     * @return null|string the API base sandbox used by the client to send requests
     */
    public function getApiBaseSandbox(): string
    {
        return $this->config['api_base_sandbox'];
    }

    /**
     * Request to PortWallet API
     *
     * @param string $method request method
     * @param string $path request url
     * @param array $params request params
     * @param array $data request body
     * @return ResponseInterface
     * @throws PortWalletClientException
     */
    public function request(string $method, string $path, array $params = [], array $data = []): ResponseInterface
    {
        $method = strtoupper($method);
        $url = $this->buildPath($path);
        $data = isset($data) ? json_decode(json_encode($data)) : [];
        $headers = [];

        $headers['Authorization'] = $this->getAuthorization();
        $options = [
            'headers' => array_merge($headers, []),
            'query' => $params
        ];

        if ($method !== 'GET') {
            $headers['Content-Type'] = 'application/json';
            $options = [
                'headers' => $headers,
                'body' => json_encode($data)
            ];
        }

        try {
            $client = HttpClient::create();
            return $client->request($method, $url, $options);
        } catch (TransportExceptionInterface $e) {
            throw new PortWalletClientException($e);
        }
    }

    /**
     * Get default configurations
     *
     * @return array
     */
    private function getDefaultConfig(): array
    {
        return [
            'api_key' => '',
            'api_secret' => '',
            'api_base_live' => PortWallet::$apiBaseLive,
            'api_base_sandbox' => PortWallet::$apiBaseSandbox,
            'api_version' => PortWallet::$apiVersion,
            'api_mode' => PortWallet::$apiMode
        ];
    }

    /**
     * @param array<string, mixed> $config
     *
     * @throws InvalidArgumentException
     */
    private function validateConfig($config)
    {
        // check absence of extra keys
        $extraConfigKeys = \array_diff(\array_keys($config), \array_keys($this->getDefaultConfig()));
        if (!empty($extraConfigKeys)) {
            throw new InvalidArgumentException('Found unknown key(s) in configuration array: ' . \implode(',', $extraConfigKeys));
        }
    }

    /**
     * Build full API url
     *
     * @param string $path
     * @return string
     */
    private function buildPath(string $path): string
    {
        $api_base = $this->config['api_mode'] == 'sandbox' ? $this->config['api_base_sandbox'] : $this->config['api_base_live'];
        return trim($api_base, '/') . '/' . $this->config['api_version'] . '/' . trim($path, '/');
    }

    /**
     * Get authorization token
     *
     * @return string
     */
    private function getAuthorization(): string
    {
        return "Bearer " . base64_encode($this->config['api_key']
                . ":"
                . md5($this->config['api_secret'] . time()));
    }
}
