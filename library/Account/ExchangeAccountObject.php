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
            throw new InvalidArgumentException(sprintf(
                'The only type %s allows is "%": "%s" given',
                __CLASS__,
                $this->type,
                $type
            ));
        }
        return $this;
    }

}
