<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Account;

use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Balance\BalanceObject;
use PHPUnit_Framework_TestCase;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\ObjectProperty;

/**
 * Class AccountObjectTest
 *
 * @group account
 */
class AccountObjectTest extends PHPUnit_Framework_TestCase
{
    public function testImplementsAccountInterface()
    {
        $account = new AccountObject;
        $this->assertInstanceOf(AccountInterface::class, $account);
    }

    public function testHydrator()
    {
        $account = new AccountObject;
        $this->assertInstanceOf(HydratorAwareInterface::class, $account);

        // Test default
        $this->assertInstanceOf(MatryoshkaClassMethods::class, $account->getHydrator());

        // Other hydrator
        $anotherHydrator = new ObjectProperty;
        $account->setHydrator($anotherHydrator);
        $this->assertSame($anotherHydrator, $account->getHydrator());
    }

    public function testCtor()
    {
        $account = new AccountObject;
        $this->assertNull($account->getId());
        $this->assertNull($account->getType());

        $accountProvider = new BalanceObject;
        $accountProvider->setId('foo');
        $accountProvider->setType('baz');

        $account = new AccountObject($accountProvider);
        $this->assertSame($accountProvider->getId(), $account->getId());
        $this->assertSame($accountProvider->getType(), $account->getType());
    }
}
