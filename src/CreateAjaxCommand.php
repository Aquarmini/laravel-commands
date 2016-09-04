<?php

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
    protected $description = '创建AjaxResponseService';

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
        $res = $this->createAjaxResponse();
        if ($res !== true) {
            $this->info($res);
        }
        $res = $this->createAjaxResponseFacade();
        if ($res !== true) {
            $this->info($res);
        }
        $this->info('Command execution success...');
    }

    private function createAjaxResponseFacade()
    {
        $root = app_path('Facades');
        if (!is_dir($root)) {
            mkdir($root, 0755);
        }
        $file = $root . '/AjaxResponseFacade.php';
        if (file_exists($file)) {
            return $file . ' is exists!';
        }
        $content = '<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AjaxResponseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \'AjaxResponseService\';
    }
}';
        file_put_contents($file, $content);
        return true;
    }

    private function createAjaxResponse()
    {
        $root = app_path('Services');
        if (!is_dir($root)) {
            mkdir($root, 0755);
        }
        $file = $root . '/AjaxResponse.php';
        if (file_exists($file)) {
            return $file . ' is exists!';
        }
        $content = '<?php namespace App\Services;

class AjaxResponse
{
    protected function ajaxResponse($status = 1, $data = [], $message = \'\')
    {
        $out = [
            \'status\' => $status,
            \'message\' => $message,
            \'data\' => $data,
            \'timestamp\' => time()
        ];

        return response()->json($out);
    }

    public function success($data = null)
    {
        return $this->ajaxResponse(1, $data);
    }

    public function fail($message, $extra = [])
    {
        return $this->ajaxResponse(0, $extra, $message);
    }
}';

        file_put_contents($file, $content);
        return true;
    }
}
