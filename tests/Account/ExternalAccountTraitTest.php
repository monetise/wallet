<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseTest\Wallet\Account;

use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\AccountTrait;
use Monetise\Wallet\Account\ExternalAccountObject;
use Monetise\Wallet\Account\ExternalAccountTrait;
use PHPUnit_Framework_TestCase;

/**
 * Class ExternalAccountTraitTest
 *
 * @group account
 */
class ExternalAccountTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(ExternalAccountTrait::class);
    }

    public function testGetSetExternalId()
    {
        /* @var $traitObject ExternalAccountTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertNull($traitObject->getExternalId());
        $this->assertAttributeEquals(null, 'externalId', $traitObject);

        // Test setter
        $this->assertSame($traitObject, $traitObject->setExternalId('foo'));
        $this->assertAttributeEquals('foo', 'externalId', $traitObject);

        // Test getter
        $this->assertSame('foo', $traitObject->getExternalId());
    }

    public function testEqualTo()
    {
        $accountA = new ExternalAccountObject;
        $accountA->setExternalId('A')->setType('Foo');

        $accountB = new ExternalAccountObject;
        $accountB->setExternalId('B')->setType('Foo');

        /* @var $traitObject ExternalAccountTrait */
        $traitObject = $this->traitObject;

        $traitObject->setExternalId('A');

        $this->traitObject->expects($this->atLeastOnce())
             ->method('getType')
             ->willReturn('Foo');

        $this->assertTrue($traitObject->equalTo($accountA));
        $this->assertFalse($traitObject->equalTo($accountB));
    }
}
