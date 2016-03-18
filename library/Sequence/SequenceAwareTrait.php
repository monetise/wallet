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
 * Trait SequenceAwareTrait
 */
trait SequenceAwareTrait
{
    /**
     * Sequence number
     *
     * @var int
     */
    protected $sequence = 0;

    /**
     * Get the sequence number
     *
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set the sequence number
     *
     * @param int $sequence
     * @return $this
     */
    public function setSequence($sequence)
    {
        $this->sequence = (int)$sequence;
        return $this;
    }
}
