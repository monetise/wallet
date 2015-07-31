<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Account;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\ExchangeAccountInterface;
use Monetise\Wallet\Account\ExchangeAccountObject;
use Monetise\Wallet\Exception;
use PHPUnit_Framework_TestCase;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\ObjectProperty;

/**
 * Class ExchangeAccountObjectTest
 *
 * @group account
 */
class ExchangeAccountObjectTest extends PHPUnit_Framework_TestCase
{
    public function testImplementsAccountInterface()
    {
        $account = new ExchangeAccountObject;
        $this->assertInstanceOf(ExchangeAccountInterface::class, $account);
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

    public function testSetType()
    {
        $accountA = new ExchangeAccountObject;
        $wrong = 'SomethingElseThanExchangeAccount';
        $this->setExpectedException(
            Exception\InvalidArgumentException::class,
            sprintf(
                'The only type that %s allows is "%": "%s" given',
                ExchangeAccountObject::class,
                $accountA->getType(),
                $wrong
            )
        );
        $accountA->setType($wrong);
    }

    public function testEqualTo()
    {
        $accountA = new ExchangeAccountObject;
        $accountA->setType('ExchangeAccount');

        $accountB = new ExchangeAccountObject;
        $accountB->setType('ExchangeAccount');

        $this->assertTrue($accountA->equalTo($accountA));
        $this->assertTrue($accountA->equalTo($accountB));

        $accountC = new AccountObject;
        $accountC->setType('ExchangeAccount');

        $this->assertFalse($accountB->equalTo($accountC));
    }
}
