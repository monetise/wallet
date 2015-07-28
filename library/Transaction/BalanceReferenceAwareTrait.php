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
use Monetise\Wallet\Transaction\Balance\BalanceCollection;

/**
 * trait BalanceReferenceAwareTrait
 */
trait BalanceReferenceAwareTrait
{

    /**
     * @var \DateTime|null
     */
    protected $balanceReferenceDate;

    /**
     * @var BalanceCollectionInterface
     */
    protected $balanceReferences;

    /**
     * @return \DateTime|null
     */
    public function getBalanceReferenceDate()
    {
        return $this->balanceReferenceDate;
    }

    /**
     * @param \DateTime $balanceReferenceDate
     * @return $this
     */
    public function setBalanceReferenceDate(\DateTime $balanceReferenceDate = null)
    {
        $this->balanceReferenceDate = $balanceReferenceDate;
        return $this;
    }

    /**
     * @return BalanceCollectionInterface
     */
    public function getBalanceReferences()
    {
        if (!$this->balanceReferences) {
            $this->balanceReferences = new BalanceCollection();
        }
        return $this->balanceReferences;
    }

    /**
     *
     * @param BalanceCollectionInterface $balanceReferences
     * @return $this
     */
    public function setBalanceReferences(BalanceCollectionInterface $balanceReferences)
    {
        $this->balanceReferences = $balanceReferences;
        return $this;
    }
}
