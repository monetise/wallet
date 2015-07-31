<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Entry;

use Matryoshka\Model\Object\AbstractCollection as MatryoshkaAbstractCollection;
use Monetise\Wallet\Entry\EntryCollection;
use Monetise\Wallet\Entry\EntryCollectionInterface;

/**
 * Class EntryCollectionTest
 *
 * @group entry
 */
class EntryCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testImplements()
    {
        $c = new EntryCollection;
        $this->assertInstanceOf(EntryCollectionInterface::class, $c);
    }

    public function testExtends()
    {
        $c = new EntryCollection;
        $this->assertInstanceOf(MatryoshkaAbstractCollection::class, $c);
    }
}
