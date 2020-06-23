<?php

namespace Adaptcms\Site;

use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{
  /**
   * Perform post-registration booting of services.
   *
   * @return void
   */
  public function boot()
  {
    // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'adaptcms');
    // $this->loadViewsFrom(__DIR__.'/../resources/views', 'adaptcms');
    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

    // Publishing is only necessary when using the CLI.
    if ($this->app->runningInConsole()) {
      $this->bootForConsole();
    }
  }

  /**
   * Register any package services.
   *
   * @return void
   */
  public function register()
  {
    $this->mergeConfigFrom(__DIR__.'/../config/site.php', 'site');

    // Register the service the package provides.
    $this->app->singleton('site', function ($app) {
      return new Site;
    });
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return [
      'site'
    ];
  }

  /**
   * Console-specific booting.
   *
   * @return void
   */
  protected function bootForConsole()
  {
    // Collect vendor name, and package name.
    $vendorName = basename(realpath(__DIR__ . '/../../'));
    $packageName = basename(realpath(__DIR__ . '/../'));

    // Publishing the configuration file.
    $this->publishes([
        __DIR__.'/../config/site.php' => config_path('site.php'),
    ], 'site.config');

    // Publishing the views.
    /*$this->publishes([
        __DIR__.'/../resources/views' => base_path('resources/views/vendor/adaptcms'),
    ], 'site.views');*/

    // Publishing assets.
    /*$this->publishes([
        __DIR__.'/../resources/assets' => public_path('vendor/adaptcms'),
    ], 'site.views');*/

    // Publishing the translation files.
    /*$this->publishes([
        __DIR__.'/../resources/lang' => resource_path('lang/vendor/adaptcms'),
    ], 'site.views');*/

    // Register package commands.
    $commands = [];
    foreach (glob(__DIR__ . '/Console/Commands/*.php') as $row) {
      // init class path
      $classPath = '\\Adaptcms\\Site\\Console\\Commands\\';

      // class path with command file class name
      $commandFileClass = str_replace('.php', '', basename($row));

      $classPath .= $commandFileClass;

      $commands[] = $classPath;
    }

    $this->commands($commands);
  }
}
