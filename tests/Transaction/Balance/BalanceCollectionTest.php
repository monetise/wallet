<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Transaction\Balance;

use Monetise\Wallet\Transaction\Balance;
use Monetise\Wallet\Entry\EntryObject;
use Monetise\Wallet\Exception\InvalidArgumentException;
use Monetise\Wallet\Transaction\Balance\BalanceCollection;

/**
 * Class BalanceCollectionTest
 *
 * @group transaction
 */
class BalanceCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateValue()
    {
        $coll = new BalanceCollection;
        $right = new Balance\BalanceObject;
        $coll->append($right);

        $wrong = new EntryObject;

        $this->setExpectedException(
            InvalidArgumentException::class,
            sprintf(
                'Value added in this collection must be instance of %s, "%s" given',
                Balance\BalanceInterface::class,
                get_class($wrong)
            )
        );
        $coll->append($wrong);
    }
}
