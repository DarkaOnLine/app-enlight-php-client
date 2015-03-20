<?php namespace AppEnlight\Laravel;

use AppEnlight\Settings;
use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider  extends Provider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     *
     * @var string
     */
    protected $service_name = 'app-enlight';


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish a config file
        $configPath = __DIR__ . '/../config/'.$this->service_name.'.php';
        $this->publishes([
            $configPath => config_path($this->service_name.'.php')
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $service_name = $this->service_name;

        $this->app->singleton('AppEnlight\Laravel\ErrorHandler', function($app, $exception) use ($service_name)
        {
            $config = $app['config'][$service_name];

            //Send error if correct enviroment
            if(in_array($app->environment(),$config['notify_release_stages'])) {
                return new ErrorHandler($config, $exception);
            }

            return null;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'AppEnlight\Laravel\ErrorHandler'
        ];
    }


}