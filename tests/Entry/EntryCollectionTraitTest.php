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
use Monetise\Wallet\Account\ExternalAccountObject;
use Monetise\Wallet\Entry\EntryCollection;
use Monetise\Wallet\Entry\EntryCollectionTrait;
use Monetise\Wallet\Entry\EntryInterface;
use Monetise\Wallet\Entry\EntryObject;
use Monetise\Wallet\Exception\InvalidArgumentException;

/**
 * Class EntryCollectionTraitTest
 *
 * @group entry
 */
class EntryCollectionTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(EntryCollectionTrait::class);
    }

    public function testHasAppenMethod()
    {
        $refl = new \ReflectionClass(EntryCollectionTrait::class);

        $this->assertInstanceOf(\ReflectionMethod::class, $refl->getMethod('append'));
    }

    public function testValidateValue()
    {
        /* @var $traitObject EntryCollectionTrait */
        $traitObject = $this->traitObject;

        $right = new EntryObject;

        $traitObject->validateValue($right);

        $wrong = new \stdClass;
        $this->setExpectedException(
            InvalidArgumentException::class,
            sprintf(
                'Value added in this collection must be instance of %s, "%s" given',
                EntryInterface::class,
                get_class($wrong)
            )
        );
        $traitObject->validateValue($wrong);
    }

    public function testHasAccount()
    {
        $coll = new EntryCollection;

        $account1 = (new AccountObject)->setType('Wallet');
        $entry1 = (new EntryObject)->setAccount($account1);
        $account2 = (new ExternalAccountObject)->setExternalId('external something')->setType('VISA');
        $entry2 = (new EntryObject)->setAccount($account2);

        $coll->append($entry1);

        $this->assertFalse($coll->hasAccount($account2));

        $coll->append($entry2);

        $this->assertTrue($coll->hasAccount($account2));
        $this->assertTrue($coll->hasAccount($account1));
    }

    public function testFilterByAccount()
    {
        $coll = new EntryCollection;

        $account1 = (new AccountObject)->setType('Wallet');
        $entry1A = (new EntryObject)->setAccount($account1)
                                    ->setAmount((new MoneyObject)->setAmount(100)->setCurrency('EUR'));
        $entry1B = (new EntryObject)->setAccount($account1)
                                    ->setAmount((new MoneyObject)->setCurrency('EUR'));
        $account2 = (new ExternalAccountObject)->setExternalId('external something')->setType('VISA');
        $entry2 = (new EntryObject)->setAccount($account2);

        $coll->append($entry1B);
        $coll->append($entry1A);

        $this->assertInstanceOf(EntryCollection::class, $entries = $coll->filterByAccount($account2));
        $this->assertCount(0, $entries);

        $coll->append($entry2);
        $this->assertInstanceOf(EntryCollection::class, $entries = $coll->filterByAccount($account1));
        $this->assertCount(2, $entries);
    }

    public function testGetByAccount()
    {
        $coll = new EntryCollection;

        $account1 = (new AccountObject)->setType('Wallet');
        $entry1 = (new EntryObject)->setAccount($account1);
        $account2 = (new ExternalAccountObject)->setExternalId('external something')->setType('VISA');
        $entry2 = (new EntryObject)->setAccount($account2);

        $coll->append($entry1);

        $this->assertNull($coll->getByAccount($account2));

        $coll->append($entry2);

        $this->assertInstanceOf(EntryInterface::class, $retrievedEntry2 = $coll->getByAccount($account2));
        $this->assertSame($entry2, $retrievedEntry2);
        $this->assertInstanceOf(EntryInterface::class, $retrievedEntry1 = $coll->getByAccount($account1));
        $this->assertSame($entry1, $retrievedEntry1);
    }

    public function testExtractCurrencies()
    {
        $coll = new EntryCollection;

        $this->assertInternalType('array', $currencies = $coll->extractCurrencies());
        $this->assertEmpty($currencies);

        $amountE = (new MoneyObject);
        $accountE = (new AccountObject)->setType('Wallet');
        $entryE = (new EntryObject)->setAccount($accountE)
                                    ->setAmount($amountE);
        $amount1 = (new MoneyObject)->setAmount(100)->setCurrency('EUR');
        $account1 = (new AccountObject)->setType('Wallet');
        $entry1A = (new EntryObject)->setAccount($account1)
                                    ->setAmount($amount1);
        $amount2 = (new MoneyObject)->setAmount(250)->setCurrency('USD');
        $entry1B = (new EntryObject)->setAccount($account1)
                                    ->setAmount($amount2);
        $account2 = (new ExternalAccountObject)->setExternalId('external something')->setType('VISA');
        $entryWoAmount = (new EntryObject)->setAccount($account2); // ->setAmount((new MoneyObject)->setAmount(-100)..);

        $coll->append($entryE);
        $coll->append($entryE);
        $coll->append($entry1B);
        $coll->append($entry1A);
        $coll->append($entryWoAmount);
        $coll->append($entry1A);
        $coll->append($entryWoAmount);

        $this->assertInternalType('array', $currencies = $coll->extractCurrencies());
        $this->assertCount(3, $currencies);
        $this->assertEquals(['', 'EUR', 'USD'], $currencies);
    }
}
