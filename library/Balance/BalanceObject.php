<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Balance;

use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorAwareTrait;
use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Matryoshka\Model\Hydrator\Strategy\HasOneStrategy;
use Matryoshka\Model\Hydrator\Strategy\SetTypeStrategy;
use Monetise\Money\Money\MoneyObject;

/**
 * Class BalanceObject
 */
class BalanceObject implements BalanceInterface, HydratorAwareInterface
{
    use BalanceTrait;
    use HydratorAwareTrait;

    /**
     * Retrieve hydrator
     *
     * @return MatryoshkaClassMethods
     */
    public function getHydrator()
    {
        if (!$this->hydrator) {
            $this->hydrator = new MatryoshkaClassMethods(true);
            // Strategies
            $this->hydrator->addStrategy(
                'account_balance',
                (new HasOneStrategy(new MoneyObject))->setNullable(false)
            );
            $this->hydrator->addStrategy(
                'available_balance',
                (new HasOneStrategy(new MoneyObject))->setNullable(false)
            );
            $this->hydrator->addStrategy(
                'pending_transactions',
                (new SetTypeStrategy('array', 'array'))->setNullable(false)
            );
            $this->hydrator->addStrategy(
                'sequence',
                (new SetTypeStrategy('int', 'int'))->setNullable(false)
            );
        }

        return $this->hydrator;
    }
}
