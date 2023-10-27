<?php

namespace App\Providers;

use App\Channels\LogChannel;
use App\Channels\OceanicSMSChannel;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    Notification::extend('oceanicSMS', function ($app) {
      return new OceanicSMSChannel();
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(110);
  }
}
