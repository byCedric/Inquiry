<?php namespace Bycedric\Inquiry\Facades;

use Illuminate\Support\Facades\Facade;

class Inquiry extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'inquiry'; }

}