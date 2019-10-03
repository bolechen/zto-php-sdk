<?php

/*
 * This file is part of the bolechen/zto-php-sdk.
 *
 * (c) Bole Chen <avenger@php.net>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Bolechen\Zto;

class Track extends Api
{
    /**
     * 查询企业当前余额.
     *
     * @see   https://opendoc.gongmall.com/shi-shi-ti-xian/cha-xun-qi-ye-yu-e.html
     *
     * @return array
     */
    public function traceInterfaceNewTraces(array $data)
    {
        return $this->request('/traceInterfaceNewTraces', $data);
    }
}
