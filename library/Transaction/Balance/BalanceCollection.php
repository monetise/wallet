<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Balance;

use Monetise\Wallet\Exception\InvalidArgumentException;
use Monetise\Wallet\Transaction\Entry\EntryCollection;

/**
 * Class BalanceCollection
 */
class BalanceCollection extends EntryCollection implements BalanceCollectionInterface
{

    public function validateValue($value)
    {
        if (!$value instanceof BalanceInterface) {
            throw new InvalidArgumentException(sprintf(
                'Value added in this collection must be instance of BalanceInterface, "%s" given.',
                is_object($value) ? get_class($value) : gettype($value)
            ));
        }
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return true;
    }

}
