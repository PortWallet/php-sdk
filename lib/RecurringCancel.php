<?php

namespace PortWallet;


class RecurringCancel extends BaseObject
{
    /**
     * @var mixed
     */
    public $recurring_id;

    /**
     * @var mixed
     */
    public $message;

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
