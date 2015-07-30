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

    abstract public function getType();

    /**
     * {@inheritdoc}
     */
    public function equalTo(TypeAwareInterface $account)
    {
        return $account instanceof AccountInterface
            && $this->getId() == $account->getId()
            && $this->getType() == $account->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
}
