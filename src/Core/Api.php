<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Bolechen\Zto\Core;

use Bolechen\Zto\Zto;
use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    const API_URL = 'http://japi.zto.cn';
    const SANDBOX_API_URL = 'http://58.40.16.122:8080';

    // 以下信息获取地址 https://zop.zto.com/userCenter/userBaseInfo
    // 合作商编码(company_id)
    protected $apiCompanyId;
    // 合作商签名key
    protected $apiKey;
    private $apiUrl;

    protected $apiLists;

    public function __construct(Zto $app)
    {
        $config = $app->getConfig();

        $this->apiCompanyId = $config['apiCompanyId'];
        $this->apiKey = $config['apiKey'];

        // 测试 api 地址会变化，有配置就优先用配置文件
        $sandboxApiUrl = static::SANDBOX_API_URL;
        if (!empty($_ENV['ZTO_SANDBOX_URL'])) {
            $sandboxApiUrl = $_ENV['ZTO_SANDBOX_URL'];
        }

        // 沙盒环境
        $this->apiUrl = (isset($config['sandbox']) && $config['sandbox']) ? $sandboxApiUrl : static::API_URL;
    }

    public function __call($method, $args)
    {
        if (in_array($method, $this->apiLists)) {
            return $this->request("/$method", $args[0]);
        }
        throw new \RuntimeException("$method not implemented.");
    }

    public function request($uri, array $params = [])
    {
        $http = $this->getHttp();

        // 公共业务参数
        $params['company_id'] = $this->apiCompanyId;

        // Headers
        $http->addMiddleware($this->headerMiddleware([
            'x-companyid' => $this->apiCompanyId,
            'x-datadigest' => $this->signature($params),
        ]));

        $response = $http->post($this->apiUrl.$uri, $params);

        return json_decode($response->getBody(), true);
    }

    /**
     * 数据签名 - x-dataDigest.
     *
     * @see https://zop.zto.com/zopdoc/php.html
     *
     * @return string
     */
    protected function signature(array $paramArr)
    {
        $paramStr = urldecode(http_build_query($paramArr)).$this->apiKey;

        return base64_encode(md5($paramStr, true));
    }
}
