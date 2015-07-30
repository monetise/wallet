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
 * Trait TypeAwareTrait
 */
trait TypeAwareTrait
{
    /**
     * @var string
     */
    protected $type;

    /**
     * Set the account type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the account type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
