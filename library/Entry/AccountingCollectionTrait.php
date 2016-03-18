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
use Monetise\Wallet\Account\TypeAwareInterface;
use Monetise\Wallet\Exception;

/**
 * Trait AccountingCollectionTrait
 */
trait AccountingCollectionTrait
{
    /**
     * Sum the amounts of the entries matching the given account,
     * or null if no match is found.
     *
     * The given account must be comparable.
     *
     * @param ComparableInterface $account
     * @return MoneyInterface|null
     */
    public function sumByAccount(ComparableInterface $account)
    {
        /* @var $money MoneyInterface */
        $money = null;

        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($account->equalTo($entry->getAccount()) && $entry->getAmount()) {
                $money = $money === null ? clone $entry->getAmount() : $money->add($entry->getAmount());
            }
        }

        return $money;
    }

    /**
     * Sum only the amounts of the entries which currency matches the given currency,
     * or null if no match is found.
     *
     * The given parameter must be a (valid ISO 4217 alpha-3) currency code.
     *
     * @param string $currency
     * @return MoneyInterface|null
     */
    public function sumByCurrency($currency)
    {
        /* @var $money MoneyInterface */
        $money = null;

        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($entry->getAmount() && $entry->getAmount()->getCurrency() === $currency) {
                $money = $money === null ? clone $entry->getAmount() : $money->add($entry->getAmount());
            }
        }

        return $money;
    }

    /**
     * Sum only the amounts of the entries having an account matching the given interface.
     *
     * The given interface must inherit from ComparableInterface and TypeAwareInterface.
     *
     * @param string $interface
     * @return MoneyInterface|null
     * @throws Exception\InvalidArgumentException
     */
    public function sumAccountsByInterface($interface = AccountInterface::class)
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

        /* @var $money MoneyInterface */
        $money = null;

        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($entry->getAmount() && $entry->getAccount() instanceof $interface) {
                $money = $money === null ? clone $entry->getAmount() : $money->add($entry->getAmount());
            }
        }

        return $money;
    }

    /**
     * Retrieve all the distinct currencies
     *
     * @return array
     */
    abstract public function extractCurrencies();

    /**
     * Whether all the entry amounts regarding the same currency sum to zero or not
     *
     * @return bool
     * @throws Exception\UnexpectedValueException
     */
    public function isValid()
    {
        foreach ($this->extractCurrencies() as $currency) {
            $sum = $this->sumByCurrency($currency);
            if (!$sum) {
                throw new Exception\UnexpectedValueException(sprintf(
                    'Unexpected currency %s: can not calculate sum',
                    is_string($currency) ? '"' . $currency . '"' : gettype($currency)
                ));
            }
            if ($sum->getAmount() !== 0) {
                return false;
            }
        }

        return true;
    }
}
