<?php

namespace App\Providers;

use App\Models\Quotations\Quotation;
use App\Models\rfq\Rfq;
use App\Observers\QuotationObserver;
use App\Observers\RFQObserver;
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
     * @return void
     */
    public function boot()
    {
        //
        Rfq::observe(RFQObserver::class);
        Quotation::observe(QuotationObserver::class);
    }
}
