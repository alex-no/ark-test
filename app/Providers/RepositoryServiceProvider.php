<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Models\Repositories\BlockRepository::class, \App\Models\Repositories\BlockRepositoryEloquent::class);
        $this->app->bind(\App\Models\Repositories\TransactionRepository::class, \App\Models\Repositories\TransactionRepositoryEloquent::class);
        $this->app->bind(\App\Models\Repositories\WalletRepository::class, \App\Models\Repositories\WalletRepositoryEloquent::class);
        //:end-bindings:
    }
}
