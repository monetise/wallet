<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseTest\Balance;

use Monetise\Money\Money\MoneyObject;
use Monetise\Wallet\Balance\BalanceTrait;

/**
 * Class BalanceTraitTest
 *
 * @group balance
 */
class BalanceTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(BalanceTrait::class);
    }

    public function testGetSetSequence()
    {
        /* @var $traitObject BalanceTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertInternalType('integer', $startSequenceNum = $traitObject->getSequence());
        $this->assertEmpty($startSequenceNum);

        // Test setter
        $this->assertSame($traitObject, $traitObject->setSequence(null));
        $this->assertAttributeEquals(0, 'sequence', $traitObject);
        $testSequence = 1;
        $this->assertSame($traitObject, $traitObject->setSequence($testSequence));
        $this->assertAttributeEquals($testSequence, 'sequence', $traitObject);

        // Test getter
        $this->assertSame($testSequence, $traitObject->getSequence());
    }

    public function testGetSetPendingTransactions()
    {
        /* @var $traitObject BalanceTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertInternalType('array', $noPendingTransactions = $traitObject->getPendingTransactions());
        $this->assertEmpty($noPendingTransactions);

        // Test setter
        $testTransactions = ['abc'];
        $this->assertSame($traitObject, $traitObject->setPendingTransactions($testTransactions));
        $this->assertAttributeEquals($testTransactions, 'pendingTransactions', $traitObject);

        // Test getter
        $this->assertSame($testTransactions, $traitObject->getPendingTransactions());
    }

    public function testGetSetAccountBalance()
    {
        /* @var $traitObject BalanceTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertInstanceOf(MoneyObject::class, $accountBalance = $traitObject->getAccountBalance());
        $this->assertAttributeEquals($accountBalance, 'accountBalance', $traitObject);

        // Test setter
        $money = (new MoneyObject)->setAmount(100);
        $this->assertSame($traitObject, $traitObject->setAccountBalance($money));
        $this->assertAttributeEquals($money, 'accountBalance', $traitObject);

        // Test getter
        $this->assertSame($money, $traitObject->getAccountBalance());
    }

    public function testGetSetAvailableBalance()
    {
        /* @var $traitObject BalanceTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertInstanceOf(MoneyObject::class, $availableBalance = $traitObject->getAvailableBalance());
        $this->assertAttributeEquals($availableBalance, 'availableBalance', $traitObject);

        // Test setter
        $money = (new MoneyObject)->setAmount(100);
        $this->assertSame($traitObject, $traitObject->setAvailableBalance($money));
        $this->assertAttributeEquals($money, 'availableBalance', $traitObject);

        // Test getter
        $this->assertSame($money, $traitObject->getAvailableBalance());
    }
}
