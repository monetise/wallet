<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Entry;

use Monetise\Money\Exception\UnexpectedValueException;
use Monetise\Money\Money\MoneyInterface;
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\ComparableInterface;

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
            if ($account->equalTo($entry->getAccount())) {
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
            if ($entry->getAmount()->getCurrency() === $currency) {
                $money = $money === null ? clone $entry->getAmount() : $money->add($entry->getAmount());
            }
        }

        return $money;
    }

    /**
     * Sum only the amounts of the entries having an AccountInterface account.
     *
     * @return MoneyInterface|null
     */
    public function sumAccountInterfaceOnly()
    {
        /* @var $money MoneyInterface */
        $money = null;

        /* @var $entry EntryInterface */
        foreach ($this as $entry) {
            if ($entry->getAccount() instanceof AccountInterface) {
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
     */
    public function isValid()
    {
        foreach ($this->extractCurrencies() as $currency) {
            $sum = $this->sumByCurrency($currency);
            if (!$sum) {
                throw new UnexpectedValueException(sprintf(
                    'A sum for the existing currency "%s" must necessary exist',
                    $currency
                ));
            }
            if ($sum->getAmount() !== 0) {
                return false;
            }
        }

        return true;
    }
}
