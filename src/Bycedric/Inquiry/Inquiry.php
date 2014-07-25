<?php namespace Bycedric\Inquiry;

use Bycedric\Inquiry\Factory;

class Inquiry {

	/**
	 * All entites are stored within this array.
	 * 
	 * @var array
	 */
	protected $entities = [];

	/**
	 * Pass the query to the instance.
	 *
	 * @param \Bycedric\Inquiry\Factory $factory
	 * @param string $query
	 */
	public function __construct( Factory $factory, $query )
	{
		parse_str($query, $queries);

		foreach( $queries as $name => $value )
		{
			$this->entities[$name] = new Entity($factory, $name, $value);
		}
	}

	/**
	 * Get all entities.
	 * 
	 * @return array
	 */
	public function all()
	{
		return array_values($this->entities);
	}

	/**
	 * Check if the given key was set in the entities.
	 * 
	 * @param  string  $key
	 * @return boolean
	 */
	public function has( $key )
	{
		return array_key_exists($key, $this->entities);
	}

	/**
	 * Get the entity by the given key.
	 * 
	 * @param  string $key
	 * @return \Bycedric\Inquiry\Entity
	 */
	public function get( $key )
	{	
		if( $this->has($key) )
		{
			return $this->entities[$key];
		}

		return $default;
	}

}
