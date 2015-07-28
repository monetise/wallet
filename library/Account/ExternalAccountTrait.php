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
     * {@inheritdoc}
     */
    public function equalTo(TypeAwareInterface $account)
    {
        return $account instanceof ExternalAccountInterface
            && $this->getExternalId() == $account->getExternalId()
            && $this->getType() == $account->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalId()
    {
        return $this->externalId;
    }
}
