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
 * Trait ExternalAccountTrait
 */
trait ExternalAccountTrait
{
    /**
     * @var string
     */
    protected $externalId;

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
        return $account instanceof ExternalAccountInterface
            && $this->getExternalId() == $account->getExternalId()
            && $this->getType() == $account->getType();
    }

    /**
     * Set the external identifier
     *
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * Get the external identifier
     *
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }
}
