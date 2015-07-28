<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Balance;

use Monetise\Money\Money\MoneyInterface;
use Monetise\Wallet\Account\AccountProviderInterface;

/**
 * Interface BalanceInterface
 */
interface BalanceInterface extends AccountProviderInterface
{
    /**
     * @return MoneyInterface
     */
    public function getAccountBalance();

    /**
     * @param MoneyInterface $accountBalance
     * @return $this
    */
    public function setAccountBalance(MoneyInterface $accountBalance);

    /**
     * @return MoneyInterface
    */
    public function getAvailableBalance();

    /**
     * @param MoneyInterface $availableBalance
     * @return $this
    */
    public function setAvailableBalance(MoneyInterface $availableBalance);

    /**
     * @return array
    */
    public function getPendingTransactions();

    /**
     * @param array $pendingTransactions
     * @return $this
    */
    public function setPendingTransactions(array $pendingTransactions);

    /**
     * @return int
    */
    public function getSequence();

    /**
     * @param int $sequence
     * @return $this
    */
    public function setSequence($sequence);
}
