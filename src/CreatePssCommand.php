<?php
// +----------------------------------------------------------------------
// | CreatePssCommand [ 创建密码服务 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/9/6 Time: 11:43
// +----------------------------------------------------------------------
namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreatePssCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:limx-pss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a pwd service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $res = $this->createService();
        if ($res === false) return;
        $res = $this->createServiceFacade();
        if ($res === false) return;
        $this->info('Command execution success...');
    }

    private function createServiceFacade()
    {
        $root = app_path('Facades');
        if (!is_dir($root)) {
            mkdir($root, 0755, true);
        }
        $file = $root . '/PwdSetServiceFacade.php';
        if (file_exists($file)) {
            $this->info($file . ' is exists!');
            return false;
        }
        $content = '<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PwdSetServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\PwdSetService::class;
    }
}';
        file_put_contents($file, $content);
        return true;
    }

    private function createService()
    {
        $root = app_path('Services');
        if (!is_dir($root)) {
            mkdir($root, 0755, true);
        }
        $file = $root . '/PwdSetService.php';
        if (file_exists($file)) {
            $this->info($file . ' is exists!');
            return false;
        }
        $content = '<?php
namespace App\Services;
class PwdSetService
{
    private $key = \'your sercet key\';
    private $type = \'md5\';

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
}';

        file_put_contents($file, $content);
        return true;
    }
}