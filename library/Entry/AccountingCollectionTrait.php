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
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\ComparableInterface;

/**
 * Trait AccountingCollectionTrait
 */
trait AccountingCollectionTrait
{

    /**
     * Sum the amounts of the entries matching the given account,
     * or null if no match is found.
     *
     * The sum can be optionally restricted to internal accounts (@see $onlyInternals) matching the given account.
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return MoneyInterface|null // FIXME: make a ZeroMoneyObject
     */
    public function sumByAccount(ComparableInterface $account)
    {
        /* @var $money MoneyInterface */
        $money = null;

        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($account->equalTo($entry->getAccount())) {
                $money = $money === null ? clone $entry->getAmount() : $money->add($entry->getAmount());
            }
        }

        return $money;
    }

    /**
     * Sum only the amounts of the entries having an AccountInterface account.
     *
     * @return MoneyInterface|null // FIXME: make a ZeroMoneyObject
     */
    public function sumAccountInterfaceOnly()
    {
        /* @var $money MoneyInterface */
        $money = null;

        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($entry->getAccount() instanceof AccountInterface) {
                $money = $money === null ? clone $entry->getAmount() : $money->add($entry->getAmount());
            }
        }

        return $money;
    }

    /**
     * Whether all entry amounts sum to zero
     *
     * @return bool
     */
    public function isValid()
    {
        $moneyCheck = null;

        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if (!$moneyCheck) {
                /* @var $moneyCheck MoneyInterface */
                $moneyCheck = clone $entry->getAmount();
            } else {
                /* @var $moneyCheck MoneyInterface */
                $moneyCheck->add($entry->getAmount());
            }
        }

        return $moneyCheck === null || $moneyCheck->getAmount() === 0;
    }
}
