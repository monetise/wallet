<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account;

/**
 * Interface ComparableInterface
 */
interface ComparableInterface
{
    /**
     * @param TypeAwareInterface $account
     * @return bool
     */
    public function equalTo(TypeAwareInterface $account);
}
