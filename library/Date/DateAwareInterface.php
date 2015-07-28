<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace Monetise\Wallet\Date;

use DateTime;

/**
 * Interface DateAwareInterface
 */
interface DateAwareInterface
{
    /**
     * @param DateTime $dateCreated
     * @return $this
     */
    public function setDateCreated(DateTime $dateCreated = null);

    /**
     * @return DateTime
     */
    public function getDateCreated();

    /**
     * @param DateTime $dateModified
     * @return mixed
     */
    public function setDateModified(DateTime $dateModified = null);

    /**
     * @return DateTime
     */
    public function getDateModified();
}
