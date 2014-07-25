<?php namespace Bycedric\Inquiry;

class Factory {

	/**
	 * All symbols for the syntax.
	 *  
	 * @var array
	 */
	protected $symbols = [];

	/**
	 * All SQL operator methods.
	 * 
	 * @var array
	 */
	protected $methods = [];

	/**
	 * Set the basic syntax rules.
	 * 
	 * @param array $symbols
	 * @param array $methods
	 */
	public function __construct( array $symbols, array $methods )
	{
		$this->symbols = $symbols;
		$this->methods = $methods;
	}

	/**
	 * Parse the given input, and return a new Inquiry object.
	 * 
	 * @param  mixed $input
	 * @return \Bycedric\Inquiry\Inquiry
	 */
	public function parse( $input )
	{
		if( is_array($input) )
		{
			$input = http_build_query($input);
		}

		return new Inquiry($this, $input);
	}

	/**
	 * Get the symbols.
	 * 
	 * @return array
	 */
	public function getSymbols()
	{
		return $this->symbols;
	}

	/**
	 * Get the methods.
	 * 
	 * @return array
	 */
	public function getMethods()
	{
		return $this->methods;
	}

	/**
	 * Convert a string to camel case.
	 *   > likeThis
	 * 
	 * @param  string $string
	 * @return string
	 */
	public function camelCase( $string )
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
	public function snakeCase( $string )
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
	public function slugCase( $string )
	{
		return str_replace('_', '-', snake_case($string));
	}

	/**
	 * Transform the given string to lower case only.
	 * 
	 * @param  string $string
	 * @return string
	 */
	public function lowerCase( $string )
	{
		return strtolower($string);
	}

	/**
	 * Transform the given string to upper case only.
	 * 
	 * @param  string $string
	 * @return string
	 */
	public function upperCase( $string )
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
	public function plural( $value )
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
	public function singular( $value )
	{
		return str_singular($value);
	}

}