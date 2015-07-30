<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Sequence;

/**
 * Interface SequenceAwareInterface
 */
interface SequenceAwareInterface
{
    /**
     * Set the sequence number
     *
     * @param int $sequence
     * @return $this
     */
    public function setSequence($sequence);

    /**
     * Get the sequence number
     *
     * @return int
     */
    public function getSequence();
}
