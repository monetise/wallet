<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction;

use Monetise\Money\Money\MoneyInterface;
use Monetise\Wallet\Account\ComparableInterface;

/**
 * Interface ItemCollectionInterface
 */
interface ItemCollectionInterface extends \Traversable
{
    /**
     * Check that collection contains an item matching the given account
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return boolean
     */
    public function hasAccount(ComparableInterface $account);

    /**
     * Extract from current collection all items matching the given account,
     * returning them wrapped in a new collection
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return ItemCollectionInterface
     */
    public function filterByAccount(ComparableInterface $account);

    /**
     * Extract from current collection the first item matching the given account,
     * or null if no match is found.
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return mixed
     */
    public function getByAccount(ComparableInterface $account);

    /**
     * Sum the amounts of the items matching the given account,
     * or null if no match is found.
     *
     * The sum can be optionally restricted to internal accounts (@see $onlyInternals) matching the given account.
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @param bool $onlyInternals
     * @return MoneyInterface|null
     */
    public function sumByAccount(ComparableInterface $account, $onlyInternals = false);
}
