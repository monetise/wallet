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
use Monetise\Wallet\Account\AccountTrait;
use Monetise\Wallet\Account\AccountObject;

/**
 * Class AccountTraitTest
 */
class AccountTraitTest extends PHPUnit_Framework_TestCase
{

    /** @var AccountTraitTest */
    protected $traitObject;


    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(AccountTrait::class);
    }

    public function testGetSetId()
    {
        // Test default
        $this->assertNull($this->traitObject->getId());
        $this->assertAttributeEquals(null, 'id', $this->traitObject);


        // Test setter
        $this->assertSame($this->traitObject, $this->traitObject->setId('foo'));
        $this->assertAttributeEquals('foo', 'id', $this->traitObject);

        // Test getter
        $this->assertSame('foo', $this->traitObject->getId());
    }

    public function testEqualTo()
    {
        $accountA = new AccountObject();
        $accountA->setId('A')->setType('Foo');

        $accountB = new AccountObject();
        $accountB->setId('B')->setType('Foo');

        $this->traitObject->setId('A');

        $this->traitObject->expects($this->atLeastOnce())
             ->method('getType')
             ->willReturn('Foo');

        $this->assertTrue($this->traitObject->equalTo($accountA));
        $this->assertFalse($this->traitObject->equalTo($accountB));
    }

}
