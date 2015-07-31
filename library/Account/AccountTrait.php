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
 * Trait AccountTrait
 */
trait AccountTrait
{
    /**
     * @var string
     */
    protected $id;

    /**
     * Get the account type
     *
     * @return string
     */
    abstract public function getType();

    /**
     * Whether current external account is equal to the given account
     *
     * @param TypeAwareInterface $account
     * @return bool
     */
    public function equalTo(TypeAwareInterface $account)
    {
        return ($account instanceof AccountInterface &&
                $this->getId() == $account->getId() &&
                $this->getType() == $account->getType());
    }

    /**
     * Set the account id
     *
     * @param string|null $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the account id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }
}
