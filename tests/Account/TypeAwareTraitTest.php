<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Account;

use Monetise\Wallet\Account\TypeAwareTrait;
use PHPUnit_Framework_TestCase;

/**
 * Class TypeAwareTraitTest
 *
 * @group account
 */
class TypeAwareTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(TypeAwareTrait::class);
    }

    public function testGetSetType()
    {
        /* @var $traitObject TypeAwareTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertNull($traitObject->getType());
        $this->assertAttributeEquals(null, 'type', $traitObject);

        // Test setter
        $this->assertSame($traitObject, $traitObject->setType('Unknow'));
        $this->assertAttributeEquals('Unknow', 'type', $traitObject);

        // Test getter
        $this->assertSame('Unknow', $traitObject->getType());
    }
}
