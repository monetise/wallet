<?php
/**
 * Monetise
 *
 * @link        https://github.com/monetise/wallet
 * @copyright   Copyright (c) 2015, Ripa Club
 * @license     https://github.com/monetise/wallet/blob/master/LICENSE
 */
namespace MonetiseWalletTest\Account\PrototypeStrategy;

use Monetise\Wallet\Account\AccountObject;
use Monetise\Wallet\Account\ExchangeAccountObject;
use Monetise\Wallet\Account\ExternalAccountObject;
use Monetise\Wallet\Account\PrototypeStrategy\StaticStrategy;
use Monetise\Wallet\Account\TypeAwareObject;
use Monetise\Wallet\Exception\InvalidArgumentException;

/**
 * Class StaticStrategyTest
 *
 * @group account
 */
class StaticStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateObject()
    {
        $strategy = new StaticStrategy;

        $context = [
            'type' => 'Account',
        ];
        $this->assertInstanceOf(AccountObject::class, $strategy->createObject(null, $context));

        $context = [
            'type' => 'ExternalAccount',
        ];
        $this->assertInstanceOf(ExternalAccountObject::class, $strategy->createObject(null, $context));

        $context = [
            'type' => 'ExchangeAccount',
        ];
        $this->assertInstanceOf(ExchangeAccountObject::class, $strategy->createObject(null, $context));

        $context = [
            'type' => 'Unknow',
        ];
        $this->assertInstanceOf(TypeAwareObject::class, $strategy->createObject(null, $context));

        $objectProto = new \stdClass;
        $this->assertEquals($objectProto, $object = $strategy->createObject($objectProto));
        $this->assertNotSame($objectProto, $object);

        $objectProto = new \stdClass(['field' => 'value']);
        $context = [];
        $this->assertEquals($objectProto, $object = $strategy->createObject($objectProto, $context));
        $this->assertNotSame($objectProto, $object);

        $objectProto = false;
        $this->setExpectedException(
            InvalidArgumentException::class,
            sprintf('Object prototype must be an object, given "%s"', gettype($objectProto))
        );
        $strategy->createObject($objectProto, null);
    }
}
