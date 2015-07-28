<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Entry;

use Monetise\Wallet\Account\AccountProviderInterface;
use Monetise\Money\Money\MoneyInterface;
use Traversable;
use Monetise\Wallet\Account\ComparableInterface;

/**
 * Interface EntryCollectionInterface
 */
interface EntryCollectionInterface extends Traversable
{
    /**
     * Check if entry list contains the given account
     *
     * @param ComparableInterface $account
     * @return boolean
     */
    public function hasAccount(ComparableInterface $account);

    /**
     * Returns a new collection with entries matching the given account
     *
     * @param ComparableInterface $account
     */
    public function filterByAccount(ComparableInterface $account);

    /**
     * Returns the first entry matching the given account
     *
     * @param ComparableInterface $account
     */
    public function filterOneByAccount(ComparableInterface $account);

    /**
     * @param ComparableInterface $account
     * @return MoneyInterface
     */
    public function sumByAccount(ComparableInterface $account);

    /**
     * @return MoneyInterface
     */
    public function sumWalletAccounts();

    /**
     * @return bool
     */
    public function isValid();
}
