<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		//Register directive for blade template
		Blade::directive('customizeDate', function (string $params) {
			return "<?php printf('%s', customizeDate($params)); ?>";
		});
	}
}
