<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Transaction;

use Monetise\Wallet\Entry\AccountingCollection;
use Monetise\Wallet\Transaction\Balance;
use Monetise\Wallet\Transaction\TransactionTrait;

/**
 * Class TransactionTraitTest
 *
 * @group transaction
 */
class TransactionTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(TransactionTrait::class);
    }

    public function testGetSetEntries()
    {
        /* @var $traitObject TransactionTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertInstanceOf(AccountingCollection::class, $entries = $traitObject->getEntries());
        $this->assertAttributeEquals($entries, 'entries', $traitObject);

        // Test setter
        $coll = (new AccountingCollection);
        $this->assertSame($traitObject, $traitObject->setEntries($coll));
        $this->assertAttributeEquals($coll, 'entries', $traitObject);

        // Test getter
        $this->assertSame($coll, $traitObject->getEntries());
    }

    public function testGetSetBalances()
    {
        /* @var $traitObject TransactionTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertInstanceOf(Balance\BalanceCollection::class, $balances = $traitObject->getBalances());
        $this->assertAttributeEquals($balances, 'balances', $traitObject);

        // Test setter
        $coll = (new Balance\BalanceCollection);
        $this->assertSame($traitObject, $traitObject->setBalances($coll));
        $this->assertAttributeEquals($coll, 'balances', $traitObject);

        // Test getter
        $this->assertSame($coll, $traitObject->getBalances());
    }
}
