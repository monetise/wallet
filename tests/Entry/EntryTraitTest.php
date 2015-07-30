<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Entry;

use Monetise\Money\Money\MoneyObject;
use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\TypeAwareObject;
use Monetise\Wallet\Entry\EntryTrait;
use MonetiseWalletTest\TestAsset\ProviderObject;

/**
 * Class EntryTraitTest
 *
 * @group entry
 */
class EntryTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(EntryTrait::class);
    }

    public function testGetSetAmount()
    {
        /* @var $traitObject EntryTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertNull($amount = $traitObject->getAmount());
        $this->assertAttributeEquals($amount, 'amount', $traitObject);

        // Test setter
        $money = (new MoneyObject)->setAmount(100);
        $this->assertSame($traitObject, $traitObject->setAmount($money));
        $this->assertAttributeEquals($money, 'amount', $traitObject);

        // Test getter
        $this->assertSame($money, $traitObject->getAmount());
    }

    public function testGetSetAccount()
    {
        /* @var $traitObject EntryTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertNull($account = $traitObject->getAccount());
        $this->assertAttributeEquals($account, 'account', $traitObject);

        // Test setter
        $account = (new TypeAwareObject)->setType('Unknown');
        $this->assertSame($traitObject, $traitObject->setAccount($account));
        $this->assertAttributeEquals($account, 'account', $traitObject);

        // Test getter
        $this->assertSame($account, $traitObject->getAccount());

        // Test account provider
        $account = (new ProviderObject)->setType('Example Provider');
        $this->assertSame($traitObject, $traitObject->setAccount($account));
        $this->assertInstanceOf(AccountObject::class, $traitObject->getAccount());
    }
}
