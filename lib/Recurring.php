<?php


namespace PortWallet;


class Recurring
{
    /**
     * @var string $id
     */
    public $id;

    /**
     * @var string $status
     */
    public $status;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var object $period
     */
    public $period;

    /**
     * @var boolean $has_trial
     */
    public $has_trial;

    /**
     * @var object $trial
     */
    public $trial;

    /**
     * @var boolean $has_offers
     */
    public $has_offers;

    /**
     * @var object $offers
     */
    public $offers;

    /**
     * @var boolean $is_prorated
     */
    public $is_prorated;

    /**
     * @var object $payment
     */
    public $payment;

    /**
     * @var string $started
     */
    public $started;

    /**
     * @var string $ended_at
     */
    public $ended_at;

    /**
     * @var object $next_payment
     */
    public $next_payment;

    /**
     * @var object $customer
     */
    public $customer;

    /**
     * @var integer $user_id
     */
    public $user_id;

    /**
     * @var object $source
     */
    public $source;

    /**
     * @var array $history
     */
    public $history;


    /**
     * Recurring constructor.
     * @param object $content
     */
    public function __construct(object $content)
    {
        $this->setContent($content->data);
    }

    /**
     * Set data for recurring object
     *
     * @param object $data
     * @return void
     */
    public function setContent(object $data): void
    {
        $this->id = $data->id;
        $this->status = $data->status;
        $this->name = $data->name;
        $this->description = $data->description;
        $this->period = $data->period;
        $this->has_trial = $data->has_trial;
        $this->trial = $data->trial;
        $this->has_offers = $data->has_offers;
        $this->offers = $data->offers;
        $this->is_prorated = $data->is_prorated;
        $this->payment = $data->payment;
        $this->started = $data->started;
        $this->ended_at = $data->ended_at;
        $this->next_payment = $data->next_payment;
        $this->customer = $data->customer;
        $this->user_id = $data->user_id;
        $this->source = $data->source;
        $this->history = $data->history;
    }
}
