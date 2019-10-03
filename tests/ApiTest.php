<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Bolechen\Zto;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class ApiTest extends TestCase
{
    public $zto;
    public $data = [];

    protected function setUp()
    {
        parent::setUp();

        $config = require 'config.php';
        $this->zto = new Zto($config);

        $data['data'] = '["73120481897284", "73120325979005"]';
        $data['company_id'] = '2d33908a52124135b58d7fecbcf5489b';
        $data['msg_type'] = 'NEW_TRACES';

        $this->data = $data;
    }

    /**
     * Track Tests.
     */
    public function testTrack()
    {
        $data = $this->data;
        $data['data'] = '["73120481897284", "73120325979005"]';
        $data['msg_type'] = 'NEW_TRACES';

        $result = $this->zto->track->traceInterfaceNewTraces($data);
        $this->assertCount(2, $result['data']);
    }
}