<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Balance;

use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Entry\EntryInterface;
use Monetise\Wallet\Sequence\SequenceAwareInterface;

/**
 * Interface BalanceInterface
 */
interface BalanceInterface extends EntryInterface, SequenceAwareInterface
{
    /**
     * @return AccountInterface
     */
    public function getAccount();

    /**
     * Compare current balance with the given balance through their sequence numbers
     *
     * Comparation happens only if the balances share the account
     *
     * @param BalanceInterface $balance     A balance to compare with
     * @return int|null                     >0 if current balance succeeds the given balance,
     *                                       0 if current balance and given balance are the same,
     *                                      <0 if current balance preceeds the given balance,
     *                                      null if the balances are not comparable (i.e. not same account)
     */
    public function compareSequence(BalanceInterface $balance);
}
