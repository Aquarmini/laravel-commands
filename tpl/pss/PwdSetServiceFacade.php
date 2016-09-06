<?php
// +----------------------------------------------------------------------
// | PwdSetServiceFacade [ PwdSetService 静态代理 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | 在config/app.php 的aliases数组中增加
// | 'PSS' => App\Facades\PwdSetServiceFacade::class,
// | 调用方法 \PSS::pwd($pwd)
// +----------------------------------------------------------------------
// | Date: 2016/9/6 Time: 13:36
// +----------------------------------------------------------------------

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PwdSetServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\PwdSetService::class;
    }
}