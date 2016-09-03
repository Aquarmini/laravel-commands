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
        $this->createAjaxResponse();
        $this->createAjaxResponseFacade();
        $this->info('create file success');
    }

    private function createAjaxResponseFacade()
    {
        $root = __DIR__ . '/../../Facades/';
        if (!is_dir($root)) {
            mkdir($root, 0755);
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
        file_put_contents($root . 'AjaxResponseFacade.php', $content);
    }

    private function createAjaxResponse()
    {
        $root = __DIR__ . '/../../Services/';
        if (!is_dir($root)) {
            mkdir($root, 0755);
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
        file_put_contents($root . 'AjaxResponse.php', $content);
    }
}
