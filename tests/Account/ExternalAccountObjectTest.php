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
use Monetise\Wallet\Account\ExternalAccountInterface;
use Monetise\Wallet\Account\ExternalAccountObject;
use PHPUnit_Framework_TestCase;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\ObjectProperty;

/**
 * Class ExternalAccountObjectTest
 *
 * @group account
 */
class ExternalAccountObjectTest extends PHPUnit_Framework_TestCase
{
    public function testImplementsAccountInterface()
    {
        $account = new ExternalAccountObject;
        $this->assertInstanceOf(ExternalAccountInterface::class, $account);
    }

    public function testHydrator()
    {
        $account = new ExternalAccountObject;
        $this->assertInstanceOf(HydratorAwareInterface::class, $account);

        // Test default
        $this->assertInstanceOf(MatryoshkaClassMethods::class, $account->getHydrator());

        // Other hydrator
        $anotherHydrator = new ObjectProperty;
        $account->setHydrator($anotherHydrator);
        $this->assertSame($anotherHydrator, $account->getHydrator());
    }
}
