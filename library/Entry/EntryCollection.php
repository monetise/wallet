<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Entry;

use Matryoshka\Model\Object\AbstractCollection;

/**
 * Class EntryCollection
 */
class EntryCollection extends AbstractCollection implements EntryCollectionInterface
{
    use EntryCollectionTrait;
}
