<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Account;

use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\AccountTrait;
use PHPUnit_Framework_TestCase;

/**
 * Class AccountTraitTest
 *
 * @group account
 */
class AccountTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(AccountTrait::class);
    }

    public function testGetSetId()
    {
        /* @var $traitObject AccountTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertNull($traitObject->getId());
        $this->assertAttributeEquals(null, 'id', $traitObject);

        // Test setter
        $this->assertSame($traitObject, $traitObject->setId('foo'));
        $this->assertAttributeEquals('foo', 'id', $traitObject);

        // Test getter
        $this->assertSame('foo', $traitObject->getId());
    }

    public function testEqualTo()
    {
        $accountA = new AccountObject;
        $accountA->setId('A')->setType('Foo');

        $accountB = new AccountObject;
        $accountB->setId('B')->setType('Foo');

        /* @var $traitObject AccountTrait */
        $traitObject = $this->traitObject;

        $traitObject->setId('A');

        $this->traitObject->expects($this->atLeastOnce())
             ->method('getType')
             ->willReturn('Foo');

        $this->assertTrue($traitObject->equalTo($accountA));
        $this->assertFalse($traitObject->equalTo($accountB));
    }
}
