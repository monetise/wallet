<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseTest\Balance;

use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Monetise\Wallet\Balance\BalanceInterface;
use Monetise\Wallet\Balance\BalanceObject;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;

/**
 * Class BalanceObjectTest
 *
 * @group balance
 */
class BalanceObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsBalanceInterface()
    {
        $balance = new BalanceObject;
        $this->assertInstanceOf(BalanceInterface::class, $balance);
    }

    public function testHydrator()
    {
        $balance = new BalanceObject;
        $this->assertInstanceOf(HydratorAwareInterface::class, $balance);

        // Test default
        $this->assertInstanceOf(MatryoshkaClassMethods::class, $balance->getHydrator());
    }
}
