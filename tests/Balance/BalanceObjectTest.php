<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Balance;

use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Matryoshka\Model\Hydrator\Strategy\HasOneStrategy;
use Matryoshka\Model\Hydrator\Strategy\SetTypeStrategy;
use Monetise\Wallet\Balance\BalanceInterface;
use Monetise\Wallet\Balance\BalanceObject;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\ObjectProperty;

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
        $this->assertInstanceOf(MatryoshkaClassMethods::class, $defaultHydrator = $balance->getHydrator());
        $this->assertInstanceOf(HasOneStrategy::class, $defaultHydrator->getStrategy('account_balance'));
        $this->assertInstanceOf(HasOneStrategy::class, $defaultHydrator->getStrategy('available_balance'));
        $this->assertInstanceOf(SetTypeStrategy::class, $defaultHydrator->getStrategy('pending_transactions'));
        $this->assertInstanceOf(SetTypeStrategy::class, $defaultHydrator->getStrategy('sequence'));

        // Other hydrator
        $anotherHydrator = new ObjectProperty;
        $balance->setHydrator($anotherHydrator);
        $this->assertSame($anotherHydrator, $balance->getHydrator());
    }
}
