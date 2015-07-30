<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Entry;

use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Monetise\Wallet\Entry\EntryInterface;
use Monetise\Wallet\Entry\EntryObject;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\ObjectProperty;

/**
 * Class EntryObjectTest
 *
 * @group entry
 */
class EntryObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsEntryInterface()
    {
        $balance = new EntryObject();
        $this->assertInstanceOf(EntryInterface::class, $balance);
    }

    public function testHydrator()
    {
        $balance = new EntryObject;
        $this->assertInstanceOf(HydratorAwareInterface::class, $balance);

        // Test default
        $this->assertInstanceOf(MatryoshkaClassMethods::class, $balance->getHydrator());

        // Other hydrator
        $anotherHydrator = new ObjectProperty;
        $balance->setHydrator($anotherHydrator);
        $this->assertSame($anotherHydrator, $balance->getHydrator());
    }
}
