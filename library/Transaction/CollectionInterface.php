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
 * Interface CollectionInterface
 */
interface CollectionInterface extends \Traversable
{
    /**
     * Check that collection contains the given account
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return boolean
     */
    public function has(ComparableInterface $account);

    /**
     * Extract from current collection all entries matching the given account,
     * returning them wrapped in a new collection
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return CollectionInterface
     */
    public function filter(ComparableInterface $account);

    /**
     * Extract from current collection the first entry matching the given account,
     * or null if no match is found.
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return ComparableInterface|null
     */
    public function get(ComparableInterface $account);

    /**
     * Sum the amounts of the entries matching the given account,
     * or null if no match is found.
     *
     * The sum can be optionally restricted to wallet accounts (@see $onlyWallets).
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @param bool $onlyWallets
     * @return MoneyInterface|null
     */
    public function sum(ComparableInterface $account, $onlyWallets = false);
}
