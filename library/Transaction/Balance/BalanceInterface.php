<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Balance;

use Monetise\Wallet\Transaction\Entry\EntryInterface;

/**
 * Interface BalanceInterface
 */
interface BalanceInterface extends EntryInterface
{
    /**
     * @return int
     */
    public function getSequence();

    /**
     * @param int $sequence
     * @return $this
     */
    public function setSequence($sequence);

    /**
     * Compare sequence order
     *
     * This method returns:
     *
     * - a positive interger, if this balance is succeeding to $balance
     * - a negative interger, if this balance is previous to $balanceEntrey
     * - zero, if they are equal
     * - null, if they aren't comparable (i.e. not same wallet)
     *
     * @param BalanceInterface $balance
     * @return int|null
     */
    public function compareSequence(BalanceInterface $balance);

}
