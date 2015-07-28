<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/noledger
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/noledger/blob/master/LICENSE
 */
namespace Monetise\Wallet\Account;

/**
 * Interface ExternalAccountInterface
 */
interface ExternalAccountInterface extends TypeAwareInterface, ComparableInterface
{
    /**
     * @return string
     */
    public function getExternalId();

    /**
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId);
}
