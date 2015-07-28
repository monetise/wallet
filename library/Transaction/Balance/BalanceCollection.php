<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Balance;

use Monetise\Wallet\Entry\EntryCollection;
use Monetise\Wallet\Exception;

/**
 * Class BalanceCollection
 */
class BalanceCollection extends EntryCollection implements BalanceCollectionInterface
{
    /**
     * Validate the value
     *
     * Checks that the value passed is allowed within the collection
     *
     * @param BalanceInterface $value
     * @throws Exception\InvalidArgumentException
     */
    public function validateValue($value)
    {
        if (!$value instanceof BalanceInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Value added in this collection must be instance of %s, "%s" given.',
                BalanceInterface::class,
                is_object($value) ? get_class($value) : gettype($value)
            ));
        }
    }
}
