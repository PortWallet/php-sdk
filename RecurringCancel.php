<?php

namespace PortWallet;


class RecurringCancel extends BaseObject
{
    /**
     * @var mixed
     */
    private $recurring_id;
    /**
     * @var mixed
     */
    private $message;

    protected function setContent(object $content)
    {
        $this->recurring_id = $content->data->id;
        $this->message = $content->data->message;
    }

    /**
     * @return mixed
     */
    public function getRecurringId()
    {
        return $this->recurring_id;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}
