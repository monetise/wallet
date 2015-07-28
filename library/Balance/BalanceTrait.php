<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/noledger
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/noledger/blob/master/LICENSE
 */
namespace Monetise\Wallet\Balance;

use Monetise\Wallet\Account\AccountTrait;
use Monetise\Wallet\Date\DateAwareTrait;
use Monetise\Money\Money\MoneyObject;
use Monetise\Money\Money\MoneyInterface;

trait BalanceTrait
{
    use AccountTrait;
    use DateAwareTrait;

    /**
     * @var MoneyInterface
     */
    protected $accountBalance;

    /**
     * @var MoneyInterface
     */
    protected $availableBalance;

    /**
     * @var array
     */
    protected $pendingTransactions = [];

    /**
     * @var int
    */
    protected $sequence = 0;

    /**
     * @return MoneyInterface
     */
    public function getAccountBalance()
    {
        if (!$this->accountBalance) {
            $this->accountBalance = new MoneyObject();
        }
        return $this->accountBalance;
    }

    /**
     * @param MoneyInterface $accountBalance
     * @return $this
     */
    public function setAccountBalance(MoneyInterface $accountBalance)
    {
        $this->accountBalance = $accountBalance;
        return $this;
    }


    /**
     * @return MoneyInterface
     */
    public function getAvailableBalance()
    {
        if (!$this->availableBalance) {
            $this->availableBalance = new MoneyObject();
        }
        return $this->availableBalance;
    }

    /**
     * @param MoneyInterface $availableBalance
     * @return $this
     */
    public function setAvailableBalance(MoneyInterface $availableBalance)
    {
        $this->availableBalance = $availableBalance;
        return $this;
    }

    /**
     * @return array
     */
    public function getPendingTransactions()
    {
        return $this->pendingTransactions;
    }

    /**
     * @param array $pendingTransactions
     * @return $this
     */
    public function setPendingTransactions(array $pendingTransactions)
    {
        $this->pendingTransactions = $pendingTransactions;
        return $this;
    }

    /**
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param int $sequence
     * @return $this
     */
    public function setSequence($sequence)
    {
        $this->sequence = (int) $sequence;
        return $this;
    }
}