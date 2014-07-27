<?php namespace Bycedric\Inquiry\Queries;

use Bycedric\Inquiry\Contracts\Queryable;

abstract class Query implements Queryable {

	/**
	 * The given string.
	 * 
	 * @var string
	 */
	protected $raw;

	/**
	 * Store the string as raw, for toString convertion.
	 * 
	 * @param string $string
	 */
	public function __construct( $string )
	{
		$this->raw = $string;
	}

	/**
	 * Output the given string when the object is used as string.
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->raw;
	}

	/**
	 * Convert a string to camel case.
	 *   > likeThis
	 * 
	 * @param  string $string
	 * @return string
	 */
	protected function camelCase( $string )
	{
		return camel_case($string);
	}

	/**
	 * Convert a string to snake case.
	 *   > like_this
	 * 
	 * @param  string $string
	 * @return string
	 */
	protected function snakeCase( $string )
	{
		return str_replace('-', '_', snake_case($string));
	}

	/**
	 * Convert a string to slug case.
	 *   > like-this
	 * 
	 * @param  string $string
	 * @return string
	 */
	protected function slugCase( $string )
	{
		return str_replace('_', '-', snake_case($string));
	}

	/*
	 * Transform the given string to lower case only.
	 * 
	 * @param  string $string
	 * @return string
	 */
	protected function lowerCase( $string )
	{
		return strtolower($string);
	}

	/**
	 * Transform the given string to upper case only.
	 * 
	 * @param  string $string
	 * @return string
	 */
	protected function upperCase( $string )
	{
		return strtoupper($string);
	}

	/**
	 * Convert the string to plural.
	 * Unfortunately it's only english...
	 * 
	 * @param  string $value
	 * @return string
	 */
	protected function plural( $value )
	{
		return str_plural($value);
	}

	/**
	 * Convert the string to singular.
	 * Unfortunately it's only english...
	 * 
	 * @param  string $value
	 * @return string
	 */
	protected function singular( $value )
	{
		return str_singular($value);
	}

}