<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Transaction\Balance;

use Matryoshka\Model\Hydrator\ClassMethods as MatryoshkaClassMethods;
use Matryoshka\Model\Hydrator\Strategy\HasOneStrategy;
use Matryoshka\Model\Hydrator\Strategy\SetTypeStrategy;
use Monetise\Money\Money\MoneyObject;
use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\PrototypeStrategy\StaticStrategy;
use Zend\Stdlib\Hydrator\HydratorAwareInterface;
use Zend\Stdlib\Hydrator\HydratorAwareTrait;
use Monetise\Wallet\Account\AccountInterface;
use Monetise\Wallet\Account\TypeAwareInterface;
use Monetise\Wallet\Entry\EntryObject;
use Monetise\Wallet\Exception;

/**
 * Class BalanceObject
 *
 * @method AccountInterface getAccount()
 */
class BalanceObject extends EntryObject implements BalanceInterface, HydratorAwareInterface
{
    use HydratorAwareTrait;

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
                (new HasOneStrategy(new AccountObject))->setNullable(false)->setPrototypeStrategy(new StaticStrategy)
            );
            $this->hydrator->addStrategy(
                'sequence',
                (new SetTypeStrategy('int', 'int'))->setNullable(false)
            );
        }

        return $this->hydrator;
    }
}
