<?php namespace Bycedric\Inquiry;

use Bycedric\Inquiry\Inquiry;
use Illuminate\Http\Request;

class Factory {

	/**
	 * The request to search into.
	 * 
	 * @var \Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * Set the basic syntax rules.
	 * 
	 * @param array $symbols
	 * @param array $methods
	 */
	public function __construct( Request $request )
	{
		$this->request = $request;
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
