<?php
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