<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class BladeServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		/**
		 * Register directive for blade template
		 */
		Blade::directive('customizeDate', function (string $params) {
			return "<?php echo customizeDate($params); ?>";
		});
		//Register directive admin
		Blade::if('admin', function () {
			return Auth::check() && Auth::user()->isAdmin();
		});
		//Check owner of account
		Blade::if('owner', function (int $userId) {
			return Auth::check() && Auth::id() == $userId;
		});
	}
}
