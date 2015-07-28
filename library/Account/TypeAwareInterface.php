<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account;

interface TypeAwareInterface
{
    /**
     * Get the account type
     *
     * @return string
     */
    public function getType();

    /**
     * Set the account type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type);

}