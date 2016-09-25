<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:limx-service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a service';

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
        $name = $this->argument('name');
        if (empty($name)) {
            $this->error('please input service name');
            return;
        }
        if ($this->ifFileExist($name)) {
            $this->error('the file of service name is exists');
            return;
        }
        $this->createResponseFacade($name);
        $this->createResponse($name);

    }

    private function ifFileExist($name)
    {
        $root = app_path('Services') . '/';
        if (!is_dir($root)) {
            mkdir($root, 0755);
        }
        $file = $root . $name . '.php';
        if (file_exists($file)) {
            return true;
        }

        $root = app_path('Facades') . '/';
        if (!is_dir($root)) {
            mkdir($root, 0755);
        }
        $file = $root . $name . '.php';
        if (file_exists($file)) {
            return true;
        }

        return false;
    }

    private function createResponseFacade($name)
    {
        $root = app_path('Facades') . '/';
        $content = '<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ' . $name . 'Facade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\\' . $name . '::class;;
    }
}';
        file_put_contents($root . $name . 'Facade.php', $content);
    }

    private function createResponse($name)
    {
        $root = app_path('Services') . '/';
        $content = '<?php namespace App\Services;

class ' . $name . '
{

}';
        file_put_contents($root . $name . '.php', $content);
    }
}
