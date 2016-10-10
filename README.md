# laravel-commands laravel的命令扩展 适用于5.2.* 版本
## 使用composer下载扩展包
~~~
composer limingxinleo/laravel-commands
~~~

## 修改Kernel
在app/Console/Kernel.php的$commands数组中增加一下value
~~~
Commands\CreateAjaxCommand::class       make:limx-ajax              新建AjaxResponseService
Commands\PackageCommand::class          make:limx-package           打包项目
Commands\CreateHelperCommand::class     make:limx-helper            新建HelperService
Commands\CreatePssCommand::class        make:limx-pss               新建PwdSetService
Commands\CreateWidgetCommand::class     make:limx-widget            新建WidgetService
Commands\CreateServiceCommand::class    make:limx-service {name}    新建服务和静态代理
~~~

## 使用方法
AjaxResponseService
-------------------
- 命令行运行 php artisan make:limx-ajax
- 在config/app.php的aliases数组中增加 'Ajax' => App\Facades\AjaxResponseFacade::class
- 控制器中使用 return \Ajax::success($data);

PackageCommand
--------------
- 命令行运行 php artisan make:limx-package
- 维护config/data/package.php
- 再次运行 php artisan make:limx-package

CreateServiceCommand
--------------
- 命令行运行 php artisan make:limx-service YourServceName
- 在config/app.php的aliases数组中增加 'YourServceName' => App\Facades\YourServceName::class
