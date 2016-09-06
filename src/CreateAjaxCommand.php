<?php
// +----------------------------------------------------------------------
// | CreateAjaxCommand [ 创建Ajax输出服务 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/9/6 Time: 11:43
// +----------------------------------------------------------------------

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateAjaxCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:limx-ajax';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create service AjaxResponse';

    /**
     * The console tpl path.
     *
     * @var string
     */
    protected $tpl = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tpl = dirname(__FILE__) . '/../tpl/ajax/';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $res = $this->createAjaxResponse();
        if ($res === false) return;
        $res = $this->createAjaxResponseFacade();
        if ($res === false) return;
        $this->info('Command execution success...');
    }

    private function createAjaxResponseFacade()
    {
        $root = app_path('Facades');
        $filename = 'AjaxResponseFacade.php';
        if (!is_dir($root)) {
            mkdir($root, 0755, true);
        }
        $file = $root . '/' . $filename;
        if (file_exists($file)) {
            $this->info($file . ' is exists!');
            return false;
        }

        return copy($this->tpl . $filename, $file);
    }

    private function createAjaxResponse()
    {
        $root = app_path('Services');
        $filename = 'AjaxResponse.php';
        if (!is_dir($root)) {
            mkdir($root, 0755, true);
        }
        $file = $root . '/' . $filename;
        if (file_exists($file)) {
            $this->info($file . ' is exists!');
            return false;
        }
        return copy($this->tpl . $filename, $file);
    }
}
