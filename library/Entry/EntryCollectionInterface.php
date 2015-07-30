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
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Exception;

/**
 * Interface EntryCollectionInterface
 */
interface EntryCollectionInterface extends \Traversable
{
    /**
     * Append an entry to the end of collection
     *
     * @param EntryInterface $value
     * @throws Exception\InvalidArgumentException
     */
    public function append($value);

    /**
     * Check that collection contains an entry matching the given account
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return boolean
     */
    public function hasAccount(ComparableInterface $account);

    /**
     * Extract from current collection all the entries matching the given account,
     * returning them wrapped in a new collection
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return EntryCollectionInterface
     */
    public function filterByAccount(ComparableInterface $account);

    /**
     * Extract from currenct collection all the entries which amount (quantity and currency)
     * is equal to the given amount
     *
     * @param MoneyInterface $amount
     * @return EntryCollectionInterface
     */
    public function filterByAmount(MoneyInterface $amount);

    /**
     * Retrieve all the distinct currencies
     *
     * @return array
     */
    public function extractCurrencies();

    /**
     * Extract from current collection the first entry matching the given account,
     * or null if no match is found.
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return EntryInterface
     */
    public function getByAccount(ComparableInterface $account);

    /**
     * Return an array of accounts that are instances of the given interface
     *
     * @param string $interface
     * @return array
     */
    public function getAccountsByInterface($interface = AccountInterface::class);
}
