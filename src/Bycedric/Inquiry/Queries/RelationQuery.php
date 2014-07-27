<?php namespace Bycedric\Inquiry\Queries;

use Bycedric\Inquiry\Factory;
use Bycedric\Inquiry\Queries\Query;

class RelationQuery extends Query {
	
	/**
	 * The relation name, defined by the given string.
	 * 
	 * @var string
	 */
	protected $relation;

	/**
	 * The value of the relation.
	 * 
	 * @var string
	 */
	protected $value;

	/**
	 * Parse the given string as a relation query.
	 * 
	 * @param string $string
	 */
	public function __construct( $string )
	{
		parent::__construct($string);
		
		list($relation, $value) = explode(Factory::syntax('symbols', 'relation', ':'), $string);
	
		$this->relation = $relation;
		$this->value    = $value;
	}

	/**
	 * Get the relation value from the string.
	 * 
	 * @return string
	 */
	public function getRelation()
	{
		return $this->relation;
	}

	/**
	 * Get the value of the relation.
	 * 
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Make a relation query from the given string.
	 * 
	 * @param  string $string
	 * @return \Bycedric\Inquiry\Queries\RelationQuery
	 */
	public static function make( $string )
	{
		return new static($string);
	}

	/**
	 * Check if the given string is a valid relation query.
	 * 
	 * @param  string $string
	 * @return bool
	 */
	public static function validate( $string )
	{
		return !!strpos($string, Factory::syntax('symbols', 'relation', ':'));
	}

}
