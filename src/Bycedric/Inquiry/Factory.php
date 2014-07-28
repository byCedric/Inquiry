<?php namespace Bycedric\Inquiry;

use Bycedric\Inquiry\Inquiry;
use Illuminate\Http\Request;

class Factory {

	/**
	 * The syntax to use for the queries.
	 * 
	 * @var array
	 */
	public static $SYNTAX = [];

	/**
	 * The request to search into.
	 * 
	 * @var \Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * Set the request and basic syntax rules.
	 * 
	 * @param \Illuminate\Http\Request $request
	 * @param array $syntax (default: null)
	 */
	public function __construct( Request $request, array $syntax = null )
	{
		$this->request = $request;

		if( !empty($syntax) && is_array($syntax) )
		{
			static::$SYNTAX = $syntax;
		}
	}

	/**
	 * Get a syntax value.
	 * 
	 * @param  string $type
	 * @param  string $value
	 * @param  mixed  $default (default: null)
	 * @return string|null
	 */
	public static function syntax( $type, $value, $default = null )
	{
		if( array_key_exists($type, static::$SYNTAX) && array_key_exists($value, static::$SYNTAX[$type]) )
		{
			return static::$SYNTAX[$type][$value];
		}

		return $default;
	}

	/**
	 * Create an inquiry object with custom values.
	 * 
	 * @param  string $key   [description]
	 * @param  string $value [description]
	 * @return \Bycedric\Inquiry\Inquiry
	 */
	public function make( $key, $value )
	{
		return new Inquiry($key, $value);
	}

	/**
	 * Check if the given key is defined within the query.
	 * 
	 * @param  string  $key
	 * @return boolean
	 */
	public function has( $key )
	{
		return $this->request->has($key);
	}

	/**
	 * Get a single query parameter from the request.
	 * 
	 * @param  string $key
	 * @param  mixed  $default (default: null)
	 * @return \Bycedric\Inquiry\Inquiry
	 */
	public function get( $key, $default = null )
	{
		$value = $this->request->input($key, $default);

		if( $value !== $default )
		{
			$value = new Inquiry($key, $value);
		}

		return $value;
	}

	/**
	 * Get all query parameters from the request.
	 * 
	 * @return array
	 */
	public function all()
	{
		$queries = [];

		foreach( $this->request->all() as $key => $value )
		{
			$queries[$key] = new Inquiry($key, $value);
		}

		return $queries;
	}

	/**
	 * Get only the given query parameters from the request.
	 *
	 * @param  array $keys
	 * @return array
	 */
	public function only( $keys )
	{
		$keys    = is_array($keys)? $keys: func_get_args();
		$queries = [];

		foreach( $this->request->only($keys) as $key => $value )
		{
			$queries[$key] = new Inquiry($key, $value);
		}

		return $queries;
	}

	/**
	 * Get all query parameters, without the given parameters from the request.
	 *
	 * @param  array $keys
	 * @return array
	 */
	public function except( $keys )
	{
		$keys    = is_array($keys)? $keys: func_get_args();
		$queries = [];

		foreach( $this->request->except($keys) as $key => $value )
		{
			$queries[$key] = new Inquiry($key, $value);
		}

		return $queries;
	}

}
