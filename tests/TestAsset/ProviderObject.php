<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\TestAsset;

use Monetise\Wallet\Account\AccountProviderInterface;
use Monetise\Wallet\Account\AccountTrait;
use Monetise\Wallet\Account\TypeAwareTrait;

/**
 * Class Provider
 */
class ProviderObject implements AccountProviderInterface
{
    use TypeAwareTrait;
    use AccountTrait;
}
