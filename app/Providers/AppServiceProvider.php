<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rating;
use App\ChurchQuestion;
use App\User;
use App\Observers\RatingsObserver;
use App\Observers\ChurchQuestionObserver;
use App\Observers\UserObserver;

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
    ChurchQuestion::observe(ChurchQuestionObserver::class);
    User::observe(UserObserver::class);
  }
}
