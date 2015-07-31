<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\TestAsset;

use Monetise\Wallet\Entry\AccountingCollection;

/**
 * Class WrongExtendedAccountingCollection
 */
class WrongExtendedAccountingCollection extends AccountingCollection
{
    /**
     * Override method and try to broke everything
     *
     * @return array
     */
    public function extractCurrencies()
    {
        return ['non existing currency'];
    }
}
