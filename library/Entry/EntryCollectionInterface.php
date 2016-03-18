<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Entry;

use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\ComparableInterface;
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
     * Retrieve all the distinct currencies alphabetically sorted
     *
     * Missing currencies will be referred as null.
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
     * The given interface must inherit from ComparableInterface and TypeAwareInterface.
     *
     * @param string $interface
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function getAccountsByInterface($interface = AccountInterface::class);
}
