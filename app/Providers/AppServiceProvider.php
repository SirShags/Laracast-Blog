<?php

namespace App\Providers;


use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Contracts\Pagination\Paginator;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
>>>>>>> a2b7a0d8d168f86b202c4665cc79422f425be354
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Newsletter::class, function () {
            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us21'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Gate::define('admin' , function ($user) {
            return auth()->user()?->username != 'JeffWay';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
