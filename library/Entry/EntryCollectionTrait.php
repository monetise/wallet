<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Entry;

use Monetise\Wallet\Account\ComparableInterface;
use Monetise\Wallet\Exception;
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\TypeAwareInterface;

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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * @param string $interface
     * @return array
     */
    public function getAccountsByInterface($interface = AccountInterface::class)
    {
        $comparableInterface = ComparableInterface::class;
        if (!is_subclass_of($interface, $comparableInterface)) {
            throw new InvalidArgumentException(sprintf(
                'Given interface must extends %s',
                $comparableInterface
            ));
        }

        $typeAwareInterface = TypeAwareInterface::class;
        if (!is_subclass_of($interface, $typeAwareInterface)) {
            throw new InvalidArgumentException(sprintf(
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
