<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/noledger
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/noledger/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Entry;

use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\AccountProviderInterface;
use Monetise\Money\Money\MoneyInterface;
use Monetise\Wallet\Money\MoneyObject;
use Monetise\Wallet\Account\TypeAwareInterface;
use Monetise\Wallet\Account\Monetise\Wallet\Account;

/**
 * Class EntryObject
 */
class EntryObject implements EntryInterface
{

    /**
     * @var MoneyInterface
     */
    protected $amount;

    /**
     * @var AccountInterface
     */
    protected $account;


    /**
     * @return MoneyInterface
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param MoneyInterface $amount
     * @return $this
     */
    public function setAmount(MoneyInterface $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return TypeAwareInterface
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param TypeAwareInterface $account
     * @return $this
     */
    public function setAccount(TypeAwareInterface $account)
    {
        if ($account instanceof AccountProviderInterface) {
            $account = new AccountObject($account);
        }
        $this->account = $account;
        return $this;
    }
}
