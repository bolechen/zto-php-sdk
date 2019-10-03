# 中通快递开放平台 sdk for php，非官方维护

官方 api 文档参见：https://zop.zto.com/apiDoc/

- Base on [hanson/foundation-sdk](https://github.com/HanSon/foundation-sdk) 
- 仅实现了常用功能，如需要增加功能，可以参考 `src/Api` 下面的文件自行扩展，欢迎 PR

## Installing

```shell
$ composer require bolechen/zto-php-sdk -vvv
```

## Usage

```php
<?php
$zto = new \Bolechen\Zto\Zto([
    // 官网获取的 合作商编码(company_id)
    'apiCompanyId' => '',
    'apiKey' => '',

    'debug' => true, // 调试模式
    'sandbox' => false, // 沙盒模式

    'log' => [
        'name' => 'zto',
        'file' => __DIR__.'/zto.log',
        'level' => 'debug',
        'permission' => 0777,
    ]
]);

// 查询最后一条物流信息
$params['data'] = '["680000000000","680000000001"]';
$result = $zto->trace->traceInterfaceNewTraces($params);

// 获取指定的省市区
$params['data'] = '310000';
$result = $zto->base->baseAreaGetArea($params);

// 电子面单余额查询
$params['data'] = '{"partner": "ZTO_1001149603"}';
$result = $zto->bill->partnerInsertAvailablecounter($params);
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/bolechen/zto-php-sdk/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/bolechen/zto-php-sdk/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT