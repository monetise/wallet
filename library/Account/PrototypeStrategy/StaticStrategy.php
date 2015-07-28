<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account\PrototypeStrategy;

use Matryoshka\Model\Object\PrototypeStrategy\PrototypeStrategyInterface as MatryoshkaPrototypeStrategyInterface;
use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\ExternalAccountObject;
use Monetise\Wallet\Account\TypeAwareObject;

/**
 * Class StaticStrategy
 */
class StaticStrategy implements MatryoshkaPrototypeStrategyInterface
{
    /**
     * @param object $objectPrototype
     * @param array|null $context
     * @return TypeAwareObject|object
     */
    public function createObject($objectPrototype, array $context = null)
    {
        if (!empty($context) && isset($context['type'])) {
            switch ($context['type']) {
                case 'Account':
                    return new AccountObject;
                case 'ExternalAccount':
                    return new ExternalAccountObject;
                default:
                    return new TypeAwareObject;
            }
        }

        return clone $objectPrototype; // FIXME: check it exception has to be thrown
    }
}
