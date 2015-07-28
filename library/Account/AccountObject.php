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
 * Class AccountObject
 */
class AccountObject implements AccountInterface
{
    use AccountTrait;

    public function __construct(AccountProviderInterface $account)
    {
        $this->setId($account->getId());
        $this->setType($account->getType());
    }
}
