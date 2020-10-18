<?php


namespace PortWallet;


class Invoice extends BaseObject
{
    /**
     * PortWallet payment urls 
     *
     * @var array
     */
    public $paymentUrl = [
        'sandbox' => 'https://payment-sandbox.portwallet.com/payment/',
        'live' => 'https://payment.portwallet.com/payment/',
    ];

    /**
     * @var string $invoice_id
     */
    public $invoice_id;

    /**
     * @var string $reference
     */
    public $reference;

    /**
     * @var object $order
     */
    public $order;

    /**
     * @var object $product
     */
    public $product;

    /**
     * @var object $billing
     */
    public $billing;

    /**
     * @var object $shipping
     */
    public $shipping;

    /**
     * @var array $customs
     */
    public $customs;

    /**
     * @var object $action
     */
    public $action;

    /**
     * Set invoice data
     *
     * @param object $content
     */
    protected function setContent(object $content)
    {
        $this->invoice_id = $content->data->invoice_id;
        $this->reference = $content->data->reference;
        $this->order = $content->data->order;
        $this->product = $content->data->product;
        $this->billing = $content->data->billing;
        $this->shipping = $content->data->shipping;
        $this->action = isset($content->data->action) ? $content->data->action : (object)[];
        $this->customs = isset($content->data->customs) ? $content->data->customs : [];
    }

    /**
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoice_id;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return object
     */
    public function getOrder(): object
    {
        return $this->order;
    }

    /**
     * @return object
     */
    public function getProduct(): object
    {
        return $this->product;
    }

    /**
     * @return object
     */
    public function getBilling(): object
    {
        return $this->billing;
    }

    /**
     * @return object
     */
    public function getShipping(): object
    {
        return $this->shipping;
    }

    /**
     * @return array
     */
    public function getCustoms(): array
    {
        return $this->customs;
    }

    /**
     * @return object
     */
    public function getAction(): object
    {
        return $this->action;
    }

    /**
     * Payment Url 
     *
     * @return string
     */
    public function getPaymentUrl(): string
    {
        $url = $this->paymentUrl[PortWallet::getApiMode()];
        return "{$url}{$this->invoice_id}";
    }
}
