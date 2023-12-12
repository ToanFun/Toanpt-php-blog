<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		// Set default string in schema
		Schema::defaultStringLength(255);
		// Set bootstrap for pagination
		Paginator::useBootstrapFive();
	}
}
