<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction;

use Monetise\Wallet\Transaction\Balance\BalanceCollectionInterface;

/**
 * Interface BalanceReferenceAwareInterface
 */
interface BalanceReferenceAwareInterface extends TransactionInterface
{
    /**
     * @return \DateTime|null
     */
    public function getBalanceReferenceDate();

    /**
     * @param \DateTime $balanceReferenceDate
     * @return $this
     */
    public function setBalanceReferenceDate(\DateTime $balanceReferenceDate = null);

    /**
     * @return BalanceCollectionInterface
     */
    public function getBalanceReferences();

    /**
     *
     * @param BalanceCollectionInterface $balanceReferences
     * @return $this
     */
    public function setBalanceReferences(BalanceCollectionInterface $balanceReferences);
}
