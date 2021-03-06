<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Socialite\WordPressProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require app_path('helpers.php');
        $this->bootWordpressSocialite();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    
    // private functions 
    
    private function bootWordpressSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'wordpress',
            function ($app) use ($socialite) {
                $config = $app['config']['services.wordpress'];
                return $socialite->buildProvider(WordPressProvider::class, $config);
            }
        );
    }
}
