<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account;

use Monetise\Wallet\Exception;

/**
 * Class ExchangeAccountObject
 */
class ExchangeAccountObject extends TypeAwareObject implements ExchangeAccountInterface
{
    protected $type = 'ExchangeAccount';

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        if ($type !== $this->type) {
            throw new Exception\InvalidArgumentException(sprintf(
                'The only type that %s allows is "%": "%s" given',
                __CLASS__,
                $this->type,
                $type
            ));
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function equalTo(TypeAwareInterface $account)
    {
        return $account instanceof ExchangeAccountInterface && $this->getType() == $account->getType();
    }
}
