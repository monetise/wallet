<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction;

use Monetise\Wallet\Date\DateAwareInterface;
use Monetise\Wallet\Entry\AccountingCollectionInterface;
use Monetise\Wallet\Transaction\Balance\BalanceCollectionInterface;

/**
 * Interface TransactionInterface
 *
 * @link http://martinfowler.com/eaaDev/AccountingTransaction.html
 */
interface TransactionInterface extends DateAwareInterface
{
    /**
     * Get entries collection instance
     *
     * Use ->getEntries()->append($entry) to add a single entry.
     * The total of all entries in a accounting transaction must be zero.
     *
     * @return AccountingCollectionInterface
     */
    public function getEntries();

    /**
     * Set entries collection instance
     *
     * The total of all entries in a accounting transaction must be zero.
     *
     * @param AccountingCollectionInterface $entries
     * @return $this
     */
    public function setEntries(AccountingCollectionInterface $entries);

    /**
     * Get the balances collection instance
     *
     * Included values reflect the resulting account balance when the transaction has been completed.
     *
     * @return BalanceCollectionInterface
     */
    public function getBalances();

    /**
     * Set the balances collection instance
     *
     * Included values reflect the resulting account balance when the transaction has been completed.
     *
     * @param BalanceCollectionInterface $balances
     * @return $this
     */
    public function setBalances(BalanceCollectionInterface $balances);
}
