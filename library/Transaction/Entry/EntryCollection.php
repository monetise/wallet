<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/noledger
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/noledger/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Entry;

use Monetise\Wallet\Exception\InvalidArgumentException;
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\AccountProviderInterface;
use Monetise\Money\Money\MoneyInterface;
use Matryoshka\Model\Object\AbstractCollection;
use Monetise\Wallet\Account\TypeAwareInterface;
use Monetise\Wallet\Account\ComparableInterface;

/**
 * Class EntryCollection
 */
class EntryCollection extends AbstractCollection implements EntryCollectionInterface
{

    public function validateValue($value)
    {
        if (!$value instanceof EntryInterface) {
            throw new InvalidArgumentException(sprintf(
                'Value added in this collection must be instance of EntryInterface, "%s" given.',
                is_object($value) ? get_class($value) : gettype($value)
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasAccount(ComparableInterface $account)
    {
        /*  @var $entry \Monetise\Wallet\Transaction\Entry\EntryInterface */
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
        $filteredCollection = new static;
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
    public function filterOneByAccount(ComparableInterface $account)
    {
        foreach ($this as $entry) {
            if ($account->equalTo($entry->getAccount())) {
                return $entry;
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function sumByAccount(ComparableInterface $account)
    {
        /** @var MoneyInterface $money */
        $money = null;

        /*  @var $entry \Monetise\Wallet\Transaction\Entry\EntryInterface */
        foreach ($this as $entry) {
            if ($account->equalTo($entry->getAccount())) {
                $money = $money === null ? clone $entry->getAmount() : $money->add($entry->getAmount());
            }
        }

        return $money;
    }

    /**
     * {@inheritdoc}
     */
    public function sumWalletAccounts()
    {
        /** @var MoneyInterface $money */
        $money = null;

        /*  @var $entry \Monetise\Wallet\Transaction\Entry\EntryInterface */
        foreach ($this as $entry) {
            $account = $entry->getAccount();
            if ($account instanceof AccountInterface) {
                $money = $money === null ? clone $entry->getAmount() : $money->add($entry->getAmount());
            }
        }

        return $money;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        $moneyCheck = null;

        /*  @var $entry \Monetise\Wallet\Transaction\Entry\EntryInterface */
        foreach ($this as $entry) {
            if (!$moneyCheck) {
                /** @var $moneyCheck \Monetise\Money\Money\MoneyInterface */
                $moneyCheck = clone $entry->getAmount();
            } else {
                /** @var $moneyCheck \Monetise\Money\Money\MoneyInterface */
                $moneyCheck->add($entry->getAmount());
            }
        }

        return $moneyCheck === null || $moneyCheck->getAmount() === 0;
    }
}
