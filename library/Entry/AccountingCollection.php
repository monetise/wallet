<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Entry;

use Matryoshka\Model\Object\AbstractCollection;
use Monetise\Wallet\Entry\AccountingCollectionInterface;
use Monetise\Wallet\Entry\AccountingCollectionTrait;

/**
 * Class AccountingCollection
 */
class AccountingCollection extends AbstractCollection implements AccountingCollectionInterface
{
    use AccountingCollectionTrait;
}
