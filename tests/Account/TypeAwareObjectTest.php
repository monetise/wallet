<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseTest\Wallet\Account;

use PHPUnit_Framework_TestCase;
use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Monetise\Wallet\Account\TypeAwareInterface;
use Monetise\Wallet\Account\TypeAwareObject;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\ObjectProperty;

/**
 * Class TypeAwareObjectTest
 *
 * @group account
 */
class TypeAwareObjectTest extends PHPUnit_Framework_TestCase
{
    public function testImplementsAccountInterface()
    {
        $account = new TypeAwareObject;
        $this->assertInstanceOf(TypeAwareInterface::class, $account);
    }

    public function testHydrator()
    {
        $account = new TypeAwareObject;
        $this->assertInstanceOf(HydratorAwareInterface::class, $account);

        // Test default
        $this->assertInstanceOf(MatryoshkaClassMethods::class, $account->getHydrator());

        // Other hydrator
        $anotherHydrator = new ObjectProperty;
        $account->setHydrator($anotherHydrator);
        $this->assertSame($anotherHydrator, $account->getHydrator());
    }
}
