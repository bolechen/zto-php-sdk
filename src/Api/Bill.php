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

// 电子面单.
// @see https://zop.zto.com/apiDoc/
class Bill extends Api
{
    protected $apiLists = [
        'submitOrderCode',
        'queryAvailableBalance',
        'exposeServicePushOrderService',
        'doPrint',
        'customerService',
        'getCheckStatus',
        'realnamePerUserUpload',
        'realnameOrgUserUpload',
        'queryCustInfo',
        'bindingCustomer',
    ];

    // 获取单号（无密钥）
    public function partnerInsertSubmitagent(array $data)
    {
        $data['msg_type'] = 'submitAgent';

        return $this->request('/partnerInsertSubmitagent', $data);
    }

    // 电子面单余额查询
    public function partnerInsertAvailablecounter(array $data)
    {
        $data['msg_type'] = 'availableCounter';

        return $this->request('/partnerInsertAvailablecounter', $data);
    }

    // 集包地大头笔获取
    public function bagAddrMarkGetmark(array $data)
    {
        $data['msg_type'] = 'GETMARK';

        return $this->request('/bagAddrMarkGetmark', $data);
    }
}
