<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

return [
    'apiCompanyId' => 'kfpttestCode',
    'apiKey' => 'kfpttestkey==',

    'sandbox' => true,
    'sandbox_url' => 'http://58.40.16.122:8080',
    'debug' => true,

    'log' => [
        'name' => 'zto',
        'file' => __DIR__.'/zto.log',
        'level' => 'debug',
        'permission' => 0777,
    ],
];
