<?php namespace Bycedric\Inquiry;

use Bycedric\Inquiry\Factory;
use Illuminate\Support\ServiceProvider;

class InquiryServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the service provider.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$this->package('bycedric/inquiry');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['inquiry'] = $this->app->share(function( $app )
		{
			return new Factory($app['request'], $app['config']->get('inquiry'));
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['inquiry'];
	}

}
