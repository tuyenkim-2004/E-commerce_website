<?php

namespace App\Providers;

use App\Models\ProductType;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return      
     */
    public function boot(): void
    {
        view()->composer('components.header', function ($view) {
            $categories = ProductType::all();
            $view->with('categories', $categories);
        });
    }
    // protected $client;

    // public function __construct()
    // {
    //     $this->client = new Client();
    // }

    // public function fetchData($method, $url, $options = [])
    // {
    //     return $this->client->request($method, $url, $options);
    // }

}
