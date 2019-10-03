<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

return [
    'apiCompanyId' => env('ZTO_API_COMPANY_ID', 'kfpttestCode'),
    'apiKey' => env('ZTO_API_KEY', 'kfpttestkey=='),

    'sandbox' => env('ZTO_SANDBOX', false), // 沙盒
    'debug' => env('ZTO_DEBUG', false),

    'log' => [
        'name' => 'zto',
        'file' => __DIR__.'/zto.log',
        'level' => 'debug',
        'permission' => 0777,
    ],
];
