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
 */
class DateAwareTraitTest extends PHPUnit_Framework_TestCase
{

    /** @var DateAwareTraitTest */
    protected $traitObject;


    public function setUp()
    {
        $this->traitObject = $this->getObjectForTrait(DateAwareTrait::class);
    }

    public function testGetSetDateCreated()
    {
        // Test default
        $this->assertNull($this->traitObject->getDateCreated());
        $this->assertAttributeEquals(null, 'dateCreated', $this->traitObject);

        $date = new \DateTime;

        // Test setter
        $this->assertSame($this->traitObject, $this->traitObject->setDateCreated($date));
        $this->assertAttributeEquals($date, 'dateCreated', $this->traitObject);

        // Test getter
        $this->assertSame($date, $this->traitObject->getDateCreated());
    }

    public function testGetSetDateModified()
    {
        // Test default
        $this->assertNull($this->traitObject->getDateModified());
        $this->assertAttributeEquals(null, 'dateModified', $this->traitObject);

        $date = new \DateTime;

        // Test setter
        $this->assertSame($this->traitObject, $this->traitObject->setDateModified($date));
        $this->assertAttributeEquals($date, 'dateModified', $this->traitObject);

        // Test getter
        $this->assertSame($date, $this->traitObject->getDateModified());
    }
}
