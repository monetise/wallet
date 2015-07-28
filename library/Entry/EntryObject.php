<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Entry;

use Monetise\Money\Money\MoneyObject;
use Monetise\Wallet\Account\PrototypeStrategy\StaticStrategy;
use Monetise\Wallet\Account\TypeAwareObject;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorAwareTrait;
use Matryoshka\Model\Hydrator\Strategy\HasOneStrategy;
use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;

/**
 * Class EntryObject
 */
class EntryObject implements EntryInterface, HydratorAwareInterface
{
    use EntryTrait;
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
                'amount',
                (new HasOneStrategy(new MoneyObject))->setNullable(false)
            );
            $this->hydrator->addStrategy(
                'account',
                (new HasOneStrategy(new TypeAwareObject))->setNullable(false)->setPrototypeStrategy(new StaticStrategy)
            );
        }

        return $this->hydrator;
    }
}
