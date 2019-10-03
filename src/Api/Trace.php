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

// 快件轨迹.
// @see https://zop.zto.com/apiDoc/
class Trace extends Api
{
    protected $apiLists = [
        'subscribeData',
    ];

    /**
     * 获取快件轨迹信息.
     *
     * @return array
     */
    public function traceInterfaceNewTraces(array $data)
    {
        $data['msg_type'] = 'NEW_TRACES';

        return $this->request('/traceInterfaceNewTraces', $data);
    }

    /**
     * 获取快件最新一条.
     *
     * @return array
     */
    public function traceInterfaceLatest(array $data)
    {
        $data['msg_type'] = 'LATEST';

        return $this->request('/traceInterfaceLatest', $data);
    }
}
