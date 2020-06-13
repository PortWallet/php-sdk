<?php

namespace PortWallet;

/**
 * Class PortWallet.
 */
class PortWallet
{
    /** @var string The PortWallet API key to be used for requests. */
    public static $apiKey;

    /** @var string The PortWallet API secret to be used for Connect requests. */
    public static $apiSecret;

    /** @var string The base URL for the PortWallet API. */
    public static $apiBaseLive = 'https://api.portwallet.com/payment/';

    /** @var string The base URL for the PortWallet API. */
    public static $apiBaseSandbox = 'https://api-sandbox.portwallet.com/payment/';

    /** @var string The API mode for the PortWallet API. */
    public static $apiMode = 'sandbox';

    /** @var null|string The version of the PortWallet API to use for requests. */
    public static $apiVersion = 'v2';

    /**
     * @return string the API key used for requests
     */
    public static function getApiKey()
    {
        return self::$apiKey;
    }

    /**
     * Sets the API key to be used for requests.
     *
     * @param string $apiKey
     */
    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    /**
     * @return string the API secret used for requests.
     */
    public static function getApiSecret(): string
    {
        return self::$apiSecret;
    }

    /**
     * Sets the API secret to be used for requests.
     *
     * @param string $apiSecret
     */
    public static function setApiSecret(string $apiSecret): void
    {
        self::$apiSecret = $apiSecret;
    }

    /**
     * @return string The API version used for requests. null if we're using the
     *    latest version.
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * @param string $apiVersion the API version to use for requests
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }

    /**
     * @return string The API mode used for the requests
     */
    public static function getApiMode(): string
    {
        return self::$apiMode;
    }

    /**
     * Sets the API mode used for the requests
     *
     * @param string $apiMode
     */
    public static function setApiMode(string $apiMode): void
    {
        self::$apiMode = $apiMode;
    }
}
