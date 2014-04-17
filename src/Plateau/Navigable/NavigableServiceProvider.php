<?php namespace Plateau\Navigable;

use Illuminate\Support\ServiceProvider;
use Plateau\Menus\Active;

class NavigableServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('plateau/navigable');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['navigable.active'] = $this->app->share(function($app)
		{
			return new Active($app['router']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('navigable.active', 'navigable.menu');
	}

}
