<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Entry;

use Monetise\Money\Money\MoneyInterface;
use Monetise\Wallet\Account\TypeAwareInterface;

/**
 * Interface EntryInterface
 */
interface EntryInterface
{
    /**
     * @return MoneyInterface
     */
    public function getAmount();

    /**
     * @param MoneyInterface $amount
     * @return $this
     */
    public function setAmount(MoneyInterface $amount);

    /**
     * @return TypeAwareInterface
     */
    public function getAccount();

    /**
     * @param TypeAwareInterface $account
     * @return $this
     */
    public function setAccount(TypeAwareInterface $account);
}
