<?php
// +----------------------------------------------------------------------
// | PwdSetService [ 密码服务 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/9/6 Time: 13:36
// +----------------------------------------------------------------------
namespace App\Services;
class PwdSetService
{
    private $key = 'your sercet key';
    private $type = 'md5';

    public function __construct()
    {
        //$this->key=config();
    }

    /**
     * [pwd 用户名的名文密码转化为加密密码]
     * @author limx
     * @param $pwd 名文密码
     * @return 密文密码
     */
    public function pwd($pwd)
    {
        return md5($this->key . md5($pwd));
    }

    /**
     * [check 验证密码]
     * @author limx
     * @param $pwd 名文密码
     * @param $seckey 密文密码
     * @return bool
     */
    public function check($pwd, $seckey)
    {
        return $this->pwd($pwd) === $seckey;
    }
}