<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Listing;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $totalListings = Listing::count();
        $totalFoundItems = Listing::where('status', 'found')->count();
    
        View::share(compact('totalListings', 'totalFoundItems'));
    }
}
