<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Transaction\Balance;

use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Matryoshka\Model\Hydrator\Strategy\HasOneStrategy;
use Matryoshka\Model\Hydrator\Strategy\SetTypeStrategy;
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\TypeAwareObject;
use Monetise\Wallet\Transaction\Balance;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Monetise\Wallet\Exception;

/**
 * Class BalanceObjectTest
 *
 * @group transaction
 */
class BalanceObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsAccountInterface()
    {
        $account = new Balance\BalanceObject;
        $this->assertInstanceOf(Balance\BalanceInterface::class, $account);
    }

    public function testHydrator()
    {
        $balance = new Balance\BalanceObject;
        $this->assertInstanceOf(HydratorAwareInterface::class, $balance);

        // Test default
        $this->assertInstanceOf(MatryoshkaClassMethods::class, $defaultHydrator = $balance->getHydrator());
        $this->assertInstanceOf(HasOneStrategy::class, $defaultHydrator->getStrategy('amount'));
        $this->assertInstanceOf(HasOneStrategy::class, $defaultHydrator->getStrategy('account'));
        $this->assertInstanceOf(SetTypeStrategy::class, $defaultHydrator->getStrategy('sequence'));

        // Other hydrator
        $anotherHydrator = new ObjectProperty;
        $balance->setHydrator($anotherHydrator);
        $this->assertSame($anotherHydrator, $balance->getHydrator());
    }

    public function testSetAccount()
    {
        $balance = new Balance\BalanceObject;

        $account = new AccountObject;
        $this->assertSame($balance, $balance->setAccount($account));
        $this->assertAttributeEquals($account, 'account', $balance);
        $this->assertSame($account, $balance->getAccount());

        $wrongInput = new TypeAwareObject;
        $this->setExpectedException(
            Exception\InvalidArgumentException::class,
            sprintf(
                'Transaction balance account must be an instance of %s; "%s" given',
                AccountInterface::class,
                get_class($wrongInput)
            )
        );
        $balance->setAccount($wrongInput);
    }
}
