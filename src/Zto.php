<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Bolechen\Zto;

use Hanson\Foundation\Foundation;

/**
 * Class Zto.
 */
class Zto extends Foundation
{
    protected $providers = [
        ServiceProvider::class,
    ];
}
