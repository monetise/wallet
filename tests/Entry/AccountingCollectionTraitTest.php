<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Entry;

use Monetise\Money\Money\MoneyInterface;
use Monetise\Money\Money\MoneyObject;
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\ComparableInterface;
use Monetise\Wallet\Account\ExchangeAccountInterface;
use Monetise\Wallet\Account\ExchangeAccountObject;
use Monetise\Wallet\Account\ExternalAccountInterface;
use Monetise\Wallet\Account\ExternalAccountObject;
use Monetise\Wallet\Account\TypeAwareInterface;
use Monetise\Wallet\Entry\AccountingCollection;
use Monetise\Wallet\Entry\AccountingCollectionTrait;
use Monetise\Wallet\Entry\EntryInterface;
use Monetise\Wallet\Entry\EntryObject;
use Monetise\Wallet\Exception\InvalidArgumentException;
use Monetise\Wallet\Exception\UnexpectedValueException;
use MonetiseWalletTest\TestAsset\ComparableButTypeUnawareInterface;
use MonetiseWalletTest\TestAsset\WrongExtendedAccountingCollection;

/**
 * Class AccountingCollectionTraitTest
 *
 * @group entry
 */
class AccountingCollectionTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(AccountingCollectionTrait::class);
    }

    public function testHasExtractCurrenciesethod()
    {
        $refl = new \ReflectionClass(AccountingCollectionTrait::class);

        $this->assertInstanceOf(\ReflectionMethod::class, $refl->getMethod('extractCurrencies'));
    }

    public function testSumByAccount()
    {
        $coll = new AccountingCollection;

        $amount1A = (new MoneyObject)->setAmount(100)->setCurrency('EUR');
        $account1 = (new AccountObject)->setType('Wallet');
        $entry1A = (new EntryObject)->setAccount($account1)
                                    ->setAmount($amount1A);
        $amount1B = (new MoneyObject)->setAmount(200)->setCurrency('EUR');
        $entry1B = (new EntryObject)->setAccount($account1)
                                    ->setAmount($amount1B);
        $account2 = (new ExternalAccountObject)->setExternalId('external something')->setType('VISA');
        $entry2 = (new EntryObject)->setAccount($account2);

        $coll->append($entry1B);
        $coll->append($entry1A);
        $coll->append($entry2);

        $this->assertNull($coll->sumByAccount($account2));

        $this->assertInstanceOf(MoneyInterface::class, $sum = $coll->sumByAccount($account1));
        $this->assertEquals($amount1A->add($amount1B), $sum);
    }

    public function testSumByCurrency()
    {
        $coll = new AccountingCollection;

        $accountE = (new AccountObject)->setType('Wallet');

        $amount1E = (new MoneyObject)->setAmount(100)->setCurrency('EUR');
        $entry1E = (new EntryObject)->setAccount($accountE)
                                    ->setAmount($amount1E);

        $amount2E = (new MoneyObject)->setAmount(200)->setCurrency('EUR');
        $entry2E = (new EntryObject)->setAccount($accountE)
                                    ->setAmount($amount2E);

        $account1X = (new ExternalAccountObject)->setExternalId('external something')->setType('VISA');

        $amount1X = (new MoneyObject)->setAmount(100)->setCurrency('XXX');
        $entry1X = (new EntryObject)->setAccount($account1X)
                                    ->setAmount($amount1X);

        $entry2X = (new EntryObject)->setAccount($account1X);

        $coll->append($entry1E);
        $coll->append($entry2E);
        $coll->append($entry1X);
        $coll->append($entry2X);

        $this->assertNull($coll->sumByCurrency('USD'));

        $this->assertInstanceOf(MoneyInterface::class, $sum = $coll->sumByCurrency('EUR'));
        $this->assertEquals($amount1E->add($amount2E), $sum);

        // Amount withou currency
        $coll = new AccountingCollection;
        $accountN = (new AccountObject)->setType('Wallet');
        $amountN = (new MoneyObject)->setAmount(1);
        $entryN = (new EntryObject)->setAccount($accountN)
                                   ->setAmount($amountN);
        $coll->append($entryN);

        $this->assertInstanceOf(MoneyInterface::class, $sum = $coll->sumByCurrency(null));
        $this->assertEquals(1, $sum->getAmount());
    }

    public function testSumAccountsByInterface()
    {
        $coll = new AccountingCollection;

        $account1E = (new AccountObject)->setType('Wallet');
        $amount1E = (new MoneyObject)->setAmount(100)->setCurrency('EUR');
        $entry1E = (new EntryObject)->setAccount($account1E)
                                     ->setAmount($amount1E);

        $amount2E = (new MoneyObject)->setAmount(-100)->setCurrency('EUR');
        $entry2E = (new EntryObject)->setAccount($account1E)
                                    ->setAmount($amount2E);

        $excAccountU = new ExchangeAccountObject;
        $amount1U = (new MoneyObject)->setAmount(120)->setCurrency('USD');
        $entry1U = (new EntryObject)->setAccount($excAccountU)
                                    ->setAmount($amount1U);

        $amount2U = (new MoneyObject)->setAmount(-120)->setCurrency('USD');
        $entry2U = (new EntryObject)->setAccount($excAccountU)
                                    ->setAmount($amount2U);

        $account3X = (new ExternalAccountObject)->setType('Wallet');
        $entry3X = (new EntryObject)->setAccount($account3X);

        $coll->append($entry1E);
        $coll->append($entry2E);
        $coll->append($entry1U);
        $coll->append($entry2U);
        $coll->append($entry3X);

        $this->assertNull($coll->sumAccountsByInterface(ExternalAccountInterface::class));

        $this->assertInstanceOf(MoneyInterface::class, $coll->sumAccountsByInterface(ExchangeAccountInterface::class));
        $this->assertInstanceOf(MoneyInterface::class, $coll->sumAccountsByInterface(AccountInterface::class));
    }

    public function testSumAccountByInterfaceShouldThrowInvalidArgumentWhenNotValidInterfaceIsGivenToIt()
    {
        $coll = new AccountingCollection;
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Given interface must extends ' . ComparableInterface::class
        );
        $coll->sumAccountsByInterface(EntryInterface::class);
    }

    public function testSumAccountByInterfaceShouldThrowInvalidArgumentWhenComparableButNotValidObjectIsGivenToIt()
    {
        $coll = new AccountingCollection;
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Given interface must extends ' . TypeAwareInterface::class
        );
        $coll->sumAccountsByInterface(ComparableButTypeUnawareInterface::class);
    }

    public function testIsValid()
    {
        $coll = new AccountingCollection;

        $account1E = (new AccountObject)->setType('Wallet');
        $amount1E = (new MoneyObject)->setAmount(100)->setCurrency('EUR');
        $entry1E = (new EntryObject)->setAccount($account1E)
            ->setAmount($amount1E);

        $amount2E = (new MoneyObject)->setAmount(-100)->setCurrency('EUR');
        $entry2E = (new EntryObject)->setAccount($account1E)
            ->setAmount($amount2E);

        $coll->append($entry1E);
        $coll->append($entry2E);

        $this->assertTrue($coll->isValid());

        $excAccountU = new ExchangeAccountObject;
        $amount1U = (new MoneyObject)->setAmount(120)->setCurrency('USD');
        $entry1U = (new EntryObject)->setAccount($excAccountU)
            ->setAmount($amount1U);

        $amount2U = (new MoneyObject)->setAmount(-100)->setCurrency('USD');
        $entry2U = (new EntryObject)->setAccount($excAccountU)
            ->setAmount($amount2U);

        $coll->append($entry1U);
        $coll->append($entry2U);

        $this->assertFalse($coll->isValid());

        $coll = new AccountingCollection;
        $account2E = (new AccountObject)->setType('Wallet');
        $amount2E = new MoneyObject; // No currency, 0 amount
        $entry2E = (new EntryObject)->setAccount($account2E)->setAmount($amount2E);
        $coll->append($entry2E);

        $this->assertTrue($coll->isValid());


        $coll = new WrongExtendedAccountingCollection;
        $account2E = (new AccountObject)->setType('Wallet');
        $amount2E = (new MoneyObject)->setAmount(100)->setCurrency('EUR');
        $entry2E = (new EntryObject)->setAccount($account2E)->setAmount($amount2E);
        $coll->append($entry2E);

        $this->setExpectedException(
            UnexpectedValueException::class,
            sprintf('Unexpected currency "%s": can not calculate sum', $coll->extractCurrencies()[0])
        );
        $coll->isValid();
    }
}
