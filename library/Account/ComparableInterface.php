<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/noledger
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/noledger/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account;

interface ComparableInterface
{
    /**
     * @param TypeAwareInterface $account
     * @return bool
     */
    public function equalTo(TypeAwareInterface $account);
}