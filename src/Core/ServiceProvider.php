<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Bolechen\Zto\Core;

use Bolechen\Zto\Api\Base;
use Bolechen\Zto\Api\Bill;
use Bolechen\Zto\Api\Order;
use Bolechen\Zto\Api\Trace;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        // 基础信息
        $pimple['base'] = function ($pimple) {
            return new Base($pimple);
        };

        // 订单服务
        $pimple['order'] = function ($pimple) {
            return new Order($pimple);
        };

        // 电子面单
        $pimple['bill'] = function ($pimple) {
            return new Bill($pimple);
        };

        // 快件轨迹
        $pimple['trace'] = function ($pimple) {
            return new Trace($pimple);
        };
    }
}
