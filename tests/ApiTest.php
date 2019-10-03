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
 * @covers \Bolechen\Zto\Api\Base
 * @covers \Bolechen\Zto\Api\Bill
 * @covers \Bolechen\Zto\Api\Order
 * @covers \Bolechen\Zto\Api\Trace
 */
class ApiTest extends TestCase
{
    public $zto;
    public $data = [];

    protected function setUp()
    {
        parent::setUp();

        $dotenv = \Dotenv\Dotenv::create(__DIR__);
        $dotenv->load();

        $config = require 'config.php';
        $this->zto = new Zto($config);
    }

    // 沙盒开关
    private function setSandBox(bool $flag, $sanboxUrl = '')
    {
        $_ENV['ZTO_SANDBOX'] = $flag;
        $_ENV['ZTO_SANDBOX_URL'] = $sanboxUrl;

        $this->setUp();
    }

    /**
     * Base Tests.
     */
    public function test_baseAreaGetArea()
    {
        $this->setSandBox(false);

        $data['data'] = '310000';

        $response = $this->zto->base->baseAreaGetArea($data);
        $this->assertSame('上海市', $response['result'][0]['fullName']);
        $this->assertSame('R5', $response['statusCode']);
    }

    public function _test_baseAreaGetAll()
    {
        $data['data'] = '';

        $response = $this->zto->base->baseAreaGetAll($data);
        $this->assertCount(35, $response['result']);
        $this->assertSame('R5', $response['statusCode']);
    }

    public function test_DoNetGatewayService()
    {
        $this->setSandBox(false);
        $data['baseOrgDto'] = '{"name":"上海","pageSize":1,"pageIndex":1}';

        $response = $this->zto->base->DoNetGatewayService($data);
        // dump($response);
        $this->assertSame('上海市', $response['data']['baseOrganize'][0]['city']);
        $this->assertSame('操作成功', $response['message']);
    }

    /**
     * Order Tests.
     */
    public function test_plateOrder()
    {
        $this->setSandBox(true);
        $data['systemParameter'] = '{"serviceCode":"StoreDeliverGoods"}';
        $data['orderInfo'] = '{"bagSize":"20,10,30","partnerCode":"3608036589234","companyCode":"GP1551922487","billCode":null,"hallCode":"S2044","startTime":null,"endTime":null,"siteCode":"","weight":1.23,"freight":0,"orderSum":230.12,"otherCharges":0,"packCharges":0,"premium":0,"price":0,"quantity":"1","remark":"","receiver":{"address":"外街道00号","city":"苏州市","company":"中通快递","county":"朝阳区","id":"","mobile":"13262709999","name":"黄某","phone":"","prov":"江苏省","zipCode":""},"sender":{"address":"华志路1685号","city":"蚌埠市","company":"中通快递股份有限公司","county":"怀远县","id":"15097756","mobile":"15216800000","name":"测试","phone":"","prov":"安徽省","zipCode":""}}';

        $response = $this->zto->order->plateOrder($data);
        $this->assertSame('200', $response['statusCode']);

        // 总对总-取消订单
        unset($data);
        $data['request'] = '[{"partnerCode":"360844819234","companyCode":"GP1551922487","reason":"客户取消"}]';
        $response = $this->zto->order->cancelOrder($data);
        $this->assertSame('200', $response['statusCode']);
    }

    /**
     * Bill Tests.
     */
    public function test_queryAvailableBalance()
    {
        $data['data'] = '{"partner":"test","datetime":"2018-01-01 10:10:10","content":{"lastNo":""},"verify":"ZTO123"}';

        $response = $this->zto->bill->queryAvailableBalance($data);
        // dump($response);
        $this->assertSame('S210', $response['statusCode']);
    }

    public function test_partnerInsertSubmitagent()
    {
        $this->setSandBox(true, 'http://58.40.16.120:9001');
        $data['data'] = '{"partner": "test","id": "xfs101100111011","type": "","tradeid": "2701843","sender": {"id": "131*****010","name": "XXX","company": "XXXXX有限公司","mobile": "1391***5678","phone": "021-87***321","area": "310118","city": "上海,上海市,青浦区","address": "华新镇华志路XXX号","zipcode": "610012","email": "ll@abc.com","im": "1924656234","starttime": "2013-05-20 12:00:00","endtime": "2013-05-20 15:00:00"    },    "receiver": {"id": "130520142097","name": "XXX","company": "XXXX有限公司","mobile": "136*****321","phone": "010-222***89","area": "501022","city": "四川省,XXX,XXXX","address": "育德路XXX号","zipcode": "610012","email": "yyj@abc.com","im": "yangyijia-abc"    },    "weight": "0.753",    "size": "12,23,11",    "quantity": "2",    "price": "126.50",    "freight": "10.00",    "premium": "0.50",    "pack_charges": "1.00",    "other_charges": "0.00",    "order_sum": "0.00",    "collect_moneytype": "CNY",    "collect_sum": "12.00",    "remark": "请勿摔货",    "order_type": "1"}';

        $response = $this->zto->bill->partnerInsertSubmitagent($data);
        $this->assertSame('单号获取成功', $response['data']['message']);
    }

    /**
     * Track Tests.
     */
    public function test_traceInterfaceNewTraces()
    {
        $this->setSandBox(true);

        $data['data'] = '["680000000000","680000000001"]';

        $response = $this->zto->trace->traceInterfaceNewTraces($data);
        // dump($response);
        $this->assertCount(1, $response['data']);
        $this->assertSame('680000000000', $response['data'][0]['billCode']);
    }

    public function test_traceInterfaceLatest()
    {
        $data['data'] = '["680000000000","680000000001"]';

        $response = $this->zto->trace->traceInterfaceNewTraces($data);
        $this->assertCount(2, $response['data'][0]);
    }
}
