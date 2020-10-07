<?php


namespace PortWallet;


class InvoiceRefund extends BaseObject
{
    /**
     * @var mixed
     */
    private $order;
    /**
     * @var mixed
     */
    private $refund;

    protected function setContent(object $content)
    {
        $this->order = $content->order;
        $this->refund = $content->refund;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getRefund()
    {
        return $this->refund;
    }
}
