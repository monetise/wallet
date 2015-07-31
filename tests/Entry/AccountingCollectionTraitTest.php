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
use Monetise\Wallet\Entry\AccountingCollectionTrait;
use Monetise\Wallet\Entry\EntryCollection;
use Monetise\Wallet\Entry\EntryCollectionTrait;
use Monetise\Wallet\Entry\EntryInterface;
use Monetise\Wallet\Entry\EntryObject;
use Monetise\Wallet\Exception\InvalidArgumentException;

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

    }

    public function testSumByCurrency()
    {

    }

    public function testSumAccountsByInterface()
    {

    }

    public function testIsValid()
    {


    }
}
