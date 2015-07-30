<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Sequence;

use Monetise\Wallet\Sequence\SequenceAwareTrait;

/**
 * Class SequenceAwareTraitTest
 *
 * @group sequence
 */
class SequenceAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;

    public function setUp()
    {
        $this->traitObject = $this->getMockForTrait(SequenceAwareTrait::class);
    }

    public function testGetSetSequence()
    {
        /* @var $traitObject SequenceAwareTrait */
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
}
