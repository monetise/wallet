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
use Monetise\Wallet\Account\ComparableInterface;

/**
 * Interface AccountingCollectionInterface
 */
interface AccountingCollectionInterface extends EntryCollectionInterface
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
    public function sumByAccount(ComparableInterface $account);

    /**
     * Sum only the amounts of the entries having an AccountInterface account.
     *
     * @return MoneyInterface|null // FIXME: make a ZeroMoneyObject
     */
    public function sumAccountInterfaceOnly();

    /**
     * Whether all entry amounts sum to zero
     *
     * @return bool
     */
    public function isValid();
}
