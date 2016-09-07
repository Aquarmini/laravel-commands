<?php
// +----------------------------------------------------------------------
// | CreateHelperCommand [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/9/7 Time: 12:51
// +----------------------------------------------------------------------
namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateHelperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:limx-widget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a widget service';

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
        $this->tpl = dirname(__FILE__) . '/../tpl/widget/';
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
        $filename = 'WidgetServiceFacade.php';
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

    private function createService()
    {
        $root = app_path('Services');
        $filename = 'WidgetService.php';
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