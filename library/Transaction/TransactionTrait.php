<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction;

use Monetise\Wallet\Date\DateAwareTrait;
use Monetise\Wallet\Entry\AccountingCollectionInterface;
use Monetise\Wallet\Entry\AccountingCollection;
use Monetise\Wallet\Transaction\Balance\BalanceCollection;
use Monetise\Wallet\Transaction\Balance\BalanceCollectionInterface;

/**
 * Trait TransactionTrait
 */
trait TransactionTrait
{
    /**
     * @var AccountingCollectionInterface
     */
    protected $entries;

    /**
     * @var BalanceCollectionInterface
     */
    protected $balances;

    /**
     * Get entries collection instance
     *
     * Use ->getEntries()->append($entry) to add a single entry.
     * The total of all entries in a accounting transaction must be zero.
     *
     * @return AccountingCollectionInterface
     */
    public function getEntries()
    {
        if (null === $this->entries) {
            $this->entries = new AccountingCollection;
        }

        return $this->entries;
    }

    /**
     * Set entries collection instance
     *
     * The total of all entries in a accounting transaction must be zero.
     *
     * @param AccountingCollectionInterface $entries
     * @return $this
     */
    public function setEntries(AccountingCollectionInterface $entries)
    {
        $this->entries = $entries;
        return $this;
    }

    /**
     * Get the balances collection instance
     *
     * Included values reflect the resulting account balance when the transaction has been completed.
     *
     * @return BalanceCollectionInterface
     */
    public function getBalances()
    {
        if (null === $this->balances) {
            $this->balances = new BalanceCollection;
        }

        return $this->balances;
    }

    /**
     * Set the balances collection instance
     *
     * Included values reflect the resulting account balance when the transaction has been completed.
     *
     * @param BalanceCollectionInterface $balances
     * @return $this
     */
    public function setBalances(BalanceCollectionInterface $balances)
    {
        $this->balances = $balances;
        return $this;
    }
}
