<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Balance;

use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\TypeAwareInterface;
use Monetise\Wallet\Entry\EntryObject;
use Monetise\Wallet\Exception;

/**
 * Class BalanceObject
 *
 * @method AccountInterface getAccount()
 */
class BalanceObject extends EntryObject implements BalanceInterface
{
    /**
     * @var int
     */
    protected $sequence = 0;

    /**
     * @param TypeAwareInterface $account
     * @return $this
     */
    public function setAccount(TypeAwareInterface $account)
    {
        if (!$account instanceof AccountInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Transaction balance account must be an instance of %s; "%s" given',
                AccountInterface::class,
                get_class($account)
            ));
        }
        return parent::setAccount($account);
    }

    /**
     * {@inheritdoc}
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * {@inheritdoc}
     */
    public function setSequence($sequence)
    {
        $this->sequence = (int) $sequence;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function compareSequence(BalanceInterface $balance)
    {
        if ($this->getAccount()->equalTo($balance->getAccount())) {
            return $this->getSequence() - $balance->getSequence();
        }

        return null;
    }
}
