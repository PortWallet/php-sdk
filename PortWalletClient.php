<?php

namespace PortWallet\SDK;

class PortWalletClient
{
    private $config;

    protected $params = [];

    public function __construct()
    {
        $this->setConfig();

        if (empty($this->config['app_key']) || empty($this->config['app_secret'])) {
            new \Exception('App key or secret key is missing.');
        }
    }

    private function setConfig(): void
    {
        $this->config = include "config.php";
    }

    public function process()
    {
        $this->params['app_key'] = $this->config['app_key'];
        $this->params['timestamp'] = time();
        $this->params['token'] = md5($this->config['app_secret'] . $this->params['timestamp']);
    }

    public function request(array $data)
    {
        // Request to API
        dd($this->params, $data);
    }

    public function ipnValidate(string $invoiceId, float $amount)
    {
        // Call to ipnValidate API
    }

    public function makeRefundRequest(string $invoiceId, array $data)
    {
        // Call to refund request
    }
}
