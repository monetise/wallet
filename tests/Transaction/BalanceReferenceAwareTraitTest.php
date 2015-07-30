<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Transaction;

use Monetise\Wallet\Transaction\BalanceReferenceAwareTrait;

/**
 * Class BalanceReferenceAwareTraitTest
 *
 * @group transaction
 */
class BalanceReferenceAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(BalanceReferenceAwareTrait::class);
    }

    public function testWhat()
    {
        $this->markTestSkipped(
            'Verifiy the consistence of BalanceReferenceAwareTrait and BalanceReferenceAwareInterface.'
        );
    }
}
