<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseTest\Wallet\Date;

use PHPUnit_Framework_TestCase;
use Monetise\Wallet\Date\DateAwareTrait;

/**
 * Class DateAwareTraitTest
 *
 * @group date
 */
class DateAwareTraitTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $traitObject;


    public function setUp()
    {
        $this->traitObject = $this->getObjectForTrait(DateAwareTrait::class);
    }

    public function testGetSetDateCreated()
    {
        /* @var $traitObject DateAwareTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertNull($traitObject->getDateCreated());
        $this->assertAttributeEquals(null, 'dateCreated', $traitObject);

        $date = new \DateTime;

        // Test setter
        $this->assertSame($traitObject, $traitObject->setDateCreated($date));
        $this->assertAttributeEquals($date, 'dateCreated', $traitObject);

        // Test getter
        $this->assertSame($date, $traitObject->getDateCreated());
    }

    public function testGetSetDateModified()
    {
        /* @var $traitObject DateAwareTrait */
        $traitObject = $this->traitObject;

        // Test default
        $this->assertNull($traitObject->getDateModified());
        $this->assertAttributeEquals(null, 'dateModified', $traitObject);

        $date = new \DateTime;

        // Test setter
        $this->assertSame($traitObject, $traitObject->setDateModified($date));
        $this->assertAttributeEquals($date, 'dateModified', $traitObject);

        // Test getter
        $this->assertSame($date, $traitObject->getDateModified());
    }
}
