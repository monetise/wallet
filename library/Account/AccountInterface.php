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
 * Interface AccountInterface
 */
interface AccountInterface extends TypeAwareInterface, ComparableInterface
{
    /**
     * Get the account id
     *
     * @return string|null
     */
    public function getId();

    /**
     * Set the account id
     *
     * @param string|null $id
     * @return $this
     */
    public function setId($id);
}
