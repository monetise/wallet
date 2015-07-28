<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/noledger
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/noledger/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account;

/**
 * Interface AccountInterface
 */
interface AccountInterface extends TypeAwareInterface, ComparableInterface
{
    /**
     * {@inheritdoc}
     */
    public function getId();

    /**
     * @param string|null $id
     */
    public function setId($id);

}
