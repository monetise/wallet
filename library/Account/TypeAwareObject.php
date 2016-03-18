<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account;

use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorAwareTrait;

/**
 * Class TypeAwareObject
 */
class TypeAwareObject implements TypeAwareInterface, HydratorAwareInterface
{
    use TypeAwareTrait;
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
        }

        return $this->hydrator;
    }
}
