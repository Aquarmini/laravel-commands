<?php
namespace App\Services;
class HelperService
{
    private $root = '/';

    /**
     * [web 返回网站根目录]
     * @author limx
     */
    public function web($path)
    {
        return $this->root . $path;
    }
}