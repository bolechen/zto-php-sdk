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

// 基础信息.
// @see https://zop.zto.com/apiDoc/
class Base extends Api
{
    protected $apiLists = [
        // 网点基础信息获取.
        'DoNetGatewayService',
    ];

    /**
     * 获取指定的省市区.
     *
     * @return array
     */
    public function baseAreaGetArea(array $data)
    {
        $data['msg_type'] = 'GET_AREA';

        return $this->request('/baseAreaGetArea', $data);
    }

    // 获取全部省市区.
    public function baseAreaGetAll(array $data)
    {
        $data['msg_type'] = 'GET_ALL';

        return $this->request('/baseAreaGetAll', $data);
    }

    // 获取时效价格.
    public function priceAndHourInterfaceGetHourPrice(array $data)
    {
        $data['msg_type'] = 'GET_HOUR_PRICE';

        return $this->request('/priceAndHourInterfaceGetHourPrice', $data);
    }
}
