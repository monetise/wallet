<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/noledger
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/noledger/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Balance;

use Monetise\Wallet\Transaction\Entry\EntryObject;

/**
 * Class BalanceObject
 */
class BalanceObject extends EntryObject implements BalanceInterface
{
    /**
     * @var int
     */
    protected $sequence = 0;

    /**
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param int $sequence
     * @return $this
     */
    public function setSequence($sequence)
    {
        $this->sequence = (int) $sequence;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function compareSequence(BalanceInterface $Balance)
    {
        if ($this->getAccount()->isEqualTo($Balance->getAccount())) {
            return $this->getSequence() - $Balance->getSequence();
        }

        return null;
    }
}
