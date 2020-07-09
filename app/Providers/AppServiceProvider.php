<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rating;
use App\Observers\RatingsObserver;

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
    Rating::observe(RatingsObserver::class);
  }
}
