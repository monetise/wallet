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
use Monetise\Wallet\Date\DateAwareTrait;
use Monetise\Wallet\Transaction\Balance\BalanceCollection;
use Monetise\Wallet\Transaction\Balance\BalanceCollectionInterface;
use Monetise\Wallet\Transaction\Entry\EntryCollection;
use Monetise\Wallet\Transaction\Entry\EntryCollectionInterface;
use Monetise\Wallet\Exception\InvalidArgumentException;


/**
 * Trait TransactionTrait
 */
trait TransactionTrait
{
    use DateAwareTrait;


    /**
     * @var EntryCollectionInterface
     */
    protected $entries;

    /**
     * @var BalanceCollectionInterface
     */
    protected $balances;


    /**
     * Get entry collection instance
     *
     * Use ->getEntries()->add($entry) to add a single entry.
     * The sum of all entries in a transaction must be zero.
     *
     * @return EntryCollectionInterface
     */
    public function getEntries()
    {
        if (null === $this->entries) {
            $this->entries = new EntryCollection();
        }

        return $this->entries;
    }

    /**
     * Set entry collection instance
     *
     * Entries are linked together so that their sum in a transaction is zero.
     *
     * @param EntryCollectionInterface $entryCollection
     * @return $this
     */
    public function setEntries(EntryCollectionInterface $entryCollection)
    {
        $this->entries = $entryCollection;
        return $entryCollection;
    }


    /**
     * Get the balance entry collection instance
     *
     * Included values reflect the resulting balance when the transaction has been completed.
     *
     * @return BalanceCollectionInterface
     */
    public function getBalances()
    {
        if (null === $this->balances) {
            $this->balances = new BalanceCollection();
        }

        return $this->balances;
    }

    /**
     * Set the balance entry collection instance
     *
     * Included values reflect the resulting balance when the transaction has been completed.
     *
     * @param BalanceCollectionInterface $BalanceCollection
     * @return $this
     */
    public function setBalances(BalanceCollectionInterface $BalanceCollection)
    {
        $this->balances = $BalanceCollection;
        return $this;
    }
}
