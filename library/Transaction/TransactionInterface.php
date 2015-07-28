<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction;

use DateTime;
use Monetise\Wallet\Date\DateAwareInterface;
use Monetise\Wallet\Transaction\Balance\BalanceCollectionInterface;
use Monetise\Wallet\Transaction\Entry\EntryCollectionInterface;

/**
 * @see http://martinfowler.com/eaaDev/AccountingTransaction.html
 *
 * Interface TransactionInterface
 */
interface TransactionInterface extends
    DateAwareInterface
{

    /**
     * Get entries collection instance
     *
     * Use ->getEntries()->add($entry) to add a single entry.
     * The total of all entries in a transaction must be zero
     *
     * @return EntryCollectionInterface
     */
    public function getEntries();

    /**
     * Set entries collection instance
     *
     * Entries are linked together so that the total of all entries in a transaction is zero
     *
     * @param EntryCollectionInterface $entryCollection
     * @return $this
     */
    public function setEntries(EntryCollectionInterface $entryCollection);

    /**
     * Get the balances collection instance
     *
     * Included values reflect the resulting balance when the transaction has been completed
     *
     * @return BalanceCollectionInterface
     */
    public function getBalances();

    /**
     * Set the balances collection instance
     *
     * Included values reflect the resulting balance when the transaction has been completed
     *
     * @param BalanceCollectionInterface $BalanceCollection
     * @return $this
     */
    public function setBalances(BalanceCollectionInterface $BalanceCollection);

}
