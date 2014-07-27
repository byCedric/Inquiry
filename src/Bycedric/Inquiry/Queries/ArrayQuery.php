<?php namespace Bycedric\Inquiry\Queries;

use Bycedric\Inquiry\Inquiry;
use Bycedric\Inquiry\Queries\Query;

class ArrayQuery extends Query {

	/**
	 * Make an array from the given string.
	 * Note, this is one of the only Queries
	 * that does not return an instance of itself.
	 * Instead, it returns a simple array.
	 * 
	 * @param  string $string
	 * @return array
	 */
	public static function make( $string )
	{
		return explode(Inquiry::SYMBOL_ARRAY, $string);
	}

	/**
	 * Check if the given string is a valid array.
	 * 
	 * @param  string $string
	 * @return bool
	 */
	public static function validate( $string )
	{
		return !!strpos($string, Inquiry::SYMBOL_ARRAY);
	}

}