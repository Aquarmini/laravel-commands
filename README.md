# laravel-commands laravel的命令扩展
## 使用composer下载扩展包
~~~
composer limingxinleo/laravel-commands
~~~

## 修改Kernel
在app/Console/Kernel.php的$commands数组中增加一下value
~~~
Commands\CreateAjaxCommand::class       make:limx-ajax          新建AjaxResponseService
Commands\PackageCommand::class          make:limx-package       打包项目
~~~

## 使用方法
AjaxResponseService
-------------------
- 命令行运行 php artisan make:limx-ajax
- 在config/app.php的aliases数组中增加 'Ajax' => App\Facades\AjaxResponseFacade::class
- 控制器中使用 \Ajax::success($data);

