<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/9/5 Time: 13:30
// +----------------------------------------------------------------------

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:limx-package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'package the program';

    /**
     * 配置文件的名称.
     *
     * @var string
     */
    protected $file_name = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $root = config_path('data');
        if (!is_dir($root)) {
            mkdir($root, 0755, true);
        }
        $this->file_name = $root . '/package.php';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $app = $this->getConfig();
        if ($app) {
            \limx\func\File::copy($app['root'], $app['files'], $app['dst']);
            \limx\func\File::zip(dirname($app['dst']), basename($app['dst']), dirname($app['dst']));
        }
    }

    private function isConfig()
    {
        if (file_exists($this->file_name)) {
            return true;
        }
        return false;
    }

    /**
     * [getConfig 获取配置文件]
     * @author limx
     * @return bool|mixed
     */
    private function getConfig()
    {
        if ($this->isConfig()) {
            $app = include $this->file_name;
            if (empty($app['root']) || empty($app['files']) || empty($app['dst'])) {
                $this->error('please set your package config');
                return false;
            }
            return $app;
        } else {
            $this->createConfig();
            $this->error('please set your package config');
            return false;
        }
    }

    /**
     * [createConfig 新建配置文件]
     * @author limx
     * @return bool|string
     */
    private function createConfig()
    {
        $content = '<?php return [
    // 项目根目录
    \'root\' => base_path(),
    // 需要打包的相对文件夹
    \'files\' => [
        \'app\',
        \'resources\',
    ],
    // 复制后的文件地址
    // 样例地址 E:\phpStudy\WWW\zips\laravel
    // 压缩地址为 E:\phpStudy\WWW\zips\laravel.zip
    \'dst\' => \'\',
];';
        if (file_exists($this->file_name)) {
            $this->error($this->file_name . ' is exists!');
            return false;
        }
        file_put_contents($this->file_name, $content);
        $this->error('package config is create success!');
        return true;
    }
}
