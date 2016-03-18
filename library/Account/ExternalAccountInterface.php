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
 * Interface ExternalAccountInterface
 */
interface ExternalAccountInterface extends TypeAwareInterface, ComparableInterface
{
    /**
     * Get the external identifier
     *
     * @return string
     */
    public function getExternalId();

    /**
     * Set the external identifier
     *
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId);
}
