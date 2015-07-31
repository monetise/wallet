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
 * Class AccountObject
 */
class AccountObject extends TypeAwareObject implements AccountInterface
{
    use AccountTrait;

    /**
     * Ctor
     *
     * @param AccountProviderInterface $account
     */
    public function __construct(AccountProviderInterface $account = null)
    {
        if ($account) {
            $this->setId($account->getId());
            $this->setType($account->getType());
        }
    }
}
