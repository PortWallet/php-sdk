<?php


namespace PortWallet;


class Recurring extends BaseObject
{
    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $status
     */
    private $status;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var object $period
     */
    private $period;

    /**
     * @var boolean $has_trial
     */
    private $has_trial;

    /**
     * @var object $trial
     */
    private $trial;

    /**
     * @var boolean $has_offers
     */
    private $has_offers;

    /**
     * @var object $offers
     */
    private $offers;

    /**
     * @var boolean $is_prorated
     */
    private $is_prorated;

    /**
     * @var object $payment
     */
    private $payment;

    /**
     * @var string $started
     */
    private $started;

    /**
     * @var string $ended_at
     */
    private $ended_at;

    /**
     * @var object $next_payment
     */
    private $next_payment;

    /**
     * @var object $customer
     */
    private $customer;

    /**
     * @var integer $user_id
     */
    private $user_id;

    /**
     * @var object $source
     */
    private $source;

    /**
     * @var array $history
     */
    private $history;

    /**
     * Set data for recurring object
     *
     * @param object $data
     * @return void
     */
    protected function setContent(object $data): void
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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return object
     */
    public function getPeriod(): object
    {
        return $this->period;
    }

    /**
     * @return bool
     */
    public function isHasTrial(): bool
    {
        return $this->has_trial;
    }

    /**
     * @return object
     */
    public function getTrial(): object
    {
        return $this->trial;
    }

    /**
     * @return bool
     */
    public function isHasOffers(): bool
    {
        return $this->has_offers;
    }

    /**
     * @return object
     */
    public function getOffers(): object
    {
        return $this->offers;
    }

    /**
     * @return bool
     */
    public function isIsProrated(): bool
    {
        return $this->is_prorated;
    }

    /**
     * @return object
     */
    public function getPayment(): object
    {
        return $this->payment;
    }

    /**
     * @return string
     */
    public function getStarted(): string
    {
        return $this->started;
    }

    /**
     * @return string
     */
    public function getEndedAt(): string
    {
        return $this->ended_at;
    }

    /**
     * @return object
     */
    public function getNextPayment(): object
    {
        return $this->next_payment;
    }

    /**
     * @return object
     */
    public function getCustomer(): object
    {
        return $this->customer;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return object
     */
    public function getSource(): object
    {
        return $this->source;
    }

    /**
     * @return array
     */
    public function getHistory(): array
    {
        return $this->history;
    }
}
