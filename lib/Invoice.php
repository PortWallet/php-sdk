<?php


namespace PortWallet;


class Invoice
{
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
     * Invoice constructor.
     * @param object $content
     */
    public function __construct(object $content)
    {
        $this->setData($content);
    }

    /**
     * Set invoice data
     *
     * @param object $content
     */
    private function setData(object $content)
    {
        $this->invoice_id = $content->data->invoice_id;
        $this->reference = $content->data->reference;
        $this->order = $content->data->order;
        $this->product = $content->data->product;
        $this->billing = $content->data->billing;
        $this->shipping = $content->data->shipping;
        $this->customs = isset($content->data->customs) ? $content->data->customs : [];
    }
}
