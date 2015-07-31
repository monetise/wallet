<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorAwareTrait;
use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;

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
