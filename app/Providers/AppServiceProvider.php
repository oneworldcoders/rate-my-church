<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rating;
use App\Question;
use App\User;
use App\Observers\RatingsObserver;
use App\Observers\QuestionObserver;
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
    Question::observe(QuestionObserver::class);
    User::observe(UserObserver::class);
  }
}
