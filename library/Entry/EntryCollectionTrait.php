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
use Monetise\Wallet\Account\TypeAwareInterface;
use Monetise\Wallet\Exception;

/**
 * Trait EntryCollectionTrait
 */
trait EntryCollectionTrait
{
    /**
     * Append an entry to the end of collection
     *
     * @param EntryInterface $value
     * @throws Exception\InvalidArgumentException
     */
    abstract public function append($value);

    /**
     * Validate the value
     *
     * Checks that the value passed is allowed within the collection
     *
     * @param EntryInterface $value
     * @throws Exception\InvalidArgumentException
     */
    public function validateValue($value)
    {
        if (!$value instanceof EntryInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Value added in this collection must be instance of %s, "%s" given',
                EntryInterface::class,
                is_object($value) ? get_class($value) : gettype($value)
            ));
        }
    }

    /**
     * Check that collection contains an entry matching the given account
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return boolean
     */
    public function hasAccount(ComparableInterface $account)
    {
        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($account->equalTo($entry->getAccount())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Extract from current collection all the entries matching the given account,
     * returning them wrapped in a new collection
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return EntryCollectionInterface
     */
    public function filterByAccount(ComparableInterface $account)
    {
        /** @var $filteredCollection EntryCollectionInterface */
        $filteredCollection = new static;
        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($account->equalTo($entry->getAccount())) {
                $filteredCollection->append($entry);
            }
        }

        return $filteredCollection;
    }

    /**
     * Retrieve all the distinct currencies alphabetically sorted
     *
     * Missing currencies will be referred as empty string.
     *
     * @return array
     */
    public function extractCurrencies()
    {
        $currencies = [];
        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            $amount = $entry->getAmount();
            if ($amount) {
                $currencies[$amount->getCurrency()] = true;
            }
        }
        if (!empty($currencies)) {
            $currencies = array_keys($currencies);
            sort($currencies, SORT_STRING);
        }

        return $currencies;
    }

    /**
     * Extract from current collection the first entry matching the given account,
     * or null if no match is found.
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return EntryInterface
     */
    public function getByAccount(ComparableInterface $account)
    {
        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($account->equalTo($entry->getAccount())) {
                return $entry;
            }
        }

        return null;
    }

    /**
     * Return an array of accounts that are instances of the given interface
     *
     * The given interface must inherit from ComparableInterface and TypeAwareInterface.
     *
     * @param string $interface
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function getAccountsByInterface($interface = AccountInterface::class)
    {
        $comparableInterface = ComparableInterface::class;
        if (!is_subclass_of($interface, $comparableInterface)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Given interface must extends %s',
                $comparableInterface
            ));
        }

        $typeAwareInterface = TypeAwareInterface::class;
        if (!is_subclass_of($interface, $typeAwareInterface)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Given interface must extends %s',
                $typeAwareInterface
            ));
        }

        $accounts = [];

        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            $account = $entry->getAccount();
            if (!$account instanceof $interface) {
                continue;
            }
            /* @var $account ComparableInterface */
            foreach ($accounts as $alreadyFoundAccount) {
                if ($account->equalTo($alreadyFoundAccount)) {
                    continue 2;
                }
            }

            $accounts[] = $account;
        }

        return $accounts;
    }
}
