<?php

namespace Ibtdi\HiSms;

use Exception;
use Ibtdi\HiSms\Console\InstallHISmsPackage;
use Ibtdi\HiSms\Response\Mapper\ResponseMapper;
use Ibtdi\HiSms\Sender\HISmsSender;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class HISmsServiceProvider
 */
class HISmsServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * @return  void
     * @throws Exception
     */
    public function register(): void
    {
        if (file_exists(__DIR__.'/../config/hisms.php')) {
            $this->mergeConfigFrom(__DIR__.'/../config/hisms.php', 'hisms');
        }

        if (file_exists(__DIR__."/../src/Response/Guide/ar_guide.php") &&
            file_exists(__DIR__."/../src/Response/Guide/en_guide.php") &&
            file_exists(__DIR__."/../src/Response/Guide/valid_response_keys.php") &&
            !empty(config('hisms.response_lang'))
        ) {
            $this->app->singleton('ar_response_guide', function ($app) {
                return require __DIR__."/../src/Response/Guide/ar_guide.php";
            });
            $this->app->singleton('en_response_guide', function ($app) {
                return require __DIR__."/../src/Response/Guide/en_guide.php";
            });
            $this->app->singleton('valid_response_keys', function ($app) {
                return require __DIR__."/../src/Response/Guide/valid_response_keys.php";
            });
        } else {
            throw new Exception('invalid files and required data');
        }
        $this->app->singleton('hisms.client', function ($app) {
            return (new HISmsManager())->configure();
        });

        $this->app->singleton('mapper', function ($app) {
            return new ResponseMapper();
        });

        $this->app->bind('hisms.sender', function ($app) {
            $client = $app['hisms.client'];
            $url = $app['config']->get('hisms.sender_url');
            return new HISmsSender($client, $url);
        });
    }

    /**
     * @return  void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config/hisms.php' => config_path('hisms.php'),], 'config');
            $this->commands([InstallHISmsPackage::class,]);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['hisms.client', 'hisms.sender', 'mapper'];
    }

}
