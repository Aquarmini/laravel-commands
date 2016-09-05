# laravel-commands laravel的命令扩展
## 使用composer下载扩展包
~~~
composer limingxinleo/laravel-commands
~~~

## 修改Kernel
在app/Console/Kernel.php的$commands数组中增加一下value
> Commands\CreateAjaxCommand::class
> Commands\PackageCommand::class
