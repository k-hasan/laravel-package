<?php


namespace Package\Development;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {

        if($this->app->runningInConsole()){
            $this->registerPublishing();
        }

        $this->registerResources();
        
    }

    public function register()
    {
        $this->commands([
            Console\ProcessCommands::class
        ]);
    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'press');

        $this->registerRoutes();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/press.php' => config_path('press.php'),
        ], 'press-config');
    }

    protected function registerRoutes()
    {


        Route::group($this->routeConfigurations(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

    }

    protected function routeConfigurations()
    {
        return [
            'prefix' => Press::path(),
            'namespace' => 'Package\Development\Http\Controllers'
        ];
    }

}