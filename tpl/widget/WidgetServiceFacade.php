<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/9/7 Time: 10:00
// +----------------------------------------------------------------------
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class WidgetServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\WidgetService::class;
    }
}