<?php

namespace PortWallet;

/**
 * Interface for a PortWallet client.
 */
interface PortWalletClientInterface
{
    /**
     * Gets the API key used by the client to send requests.
     *
     * @return null|string the API key used by the client to send requests
     */
    public function getApiKey(): string;

    /**
     * Gets the API secret used by the client to send requests.
     *
     * @return string the API secret used for requests.
     */
    public function getApiSecret(): string;

    /**
     * Gets the base URL for PortWallet's API.
     *
     * @return string the base URL for PortWallet's API
     */
    public function getApiBaseLive():string;

    /**
     * Gets the base URL for PortWallet's API.
     *
     * @return string the base URL for PortWallet's API
     */
    public function getApiBaseSandbox():string;

    /**
     * Sends a request to PortWallet's API.
     *
     * @param string $method the HTTP method
     * @param string $path the path of the request
     * @param array $params the parameters of the request
     * @param array $data request body
     *
     * @return PortWalletObject the object returned by PortWallet's API
     */
    public function request(string $method, string $path, array $params = [], array $data = []);
}
