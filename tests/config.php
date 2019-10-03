<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

// Config for test only
return [
    'apiCompanyId' => '2d33908a52124135b58d7fecbcf5489b',
    'apiKey' => '0034D173B669FC5981B073DC55B16867',

    'debug' => true, // 输出日志
    'sandbox' => false, // 沙盒

    'log' => [
        'name' => 'zto',
        'file' => __DIR__.'/zto.log',
        'level' => 'debug',
        'permission' => 0777,
    ],
];
