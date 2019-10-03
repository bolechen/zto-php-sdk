<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Bolechen\Zto\Api;

use Bolechen\Zto\Core\Api;

// 订单服务.
// @see https://zop.zto.com/apiDoc/
class Order extends Api
{
    protected $apiLists = [
        'plateOrder',
        'cancelOrder',
        'createStore',
        'getPriceForCustomer',
        'pushWeight',
        'pushCancelOrder',
        'pushRecCourierInfo',
        'OpenOrderCreate',
        'commonOrderUpdate',
        'commonOrderSearch',
        'commonOrderSearchbycode',
    ];
}
