<?php namespace Bycedric\Inquiry\Contracts;

interface Queryable {

	/**
	 * Make a new Queryable object, based on the given string.
	 * 
	 * @param  string $string
	 * @return mixed
	 */
	public static function make( $string );

	/**
	 * Check if the given string is a valid Query-type.
	 * 
	 * @param  string $string
	 * @return bool
	 */
	public static function validate( $string );

}