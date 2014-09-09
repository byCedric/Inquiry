<?php namespace Bycedric\Inquiry;

use Bycedric\Inquiry\Factory;
use Bycedric\Inquiry\Queries\ArrayQuery;
use Bycedric\Inquiry\Queries\OperatorQuery;
use Bycedric\Inquiry\Queries\RelationQuery;
use Bycedric\Inquiry\Queries\RangeQuery;

class Inquiry {

	/**
	 * The name this query value was passed by.
	 * 
	 * @var string
	 */
	protected $key;

	/**
	 * The query value.
	 * 
	 * @var string
	 */
	protected $value;

	/**
	 * Pass the query to the instance.
	 *
	 * @param string $key
	 * @param mixed  $value
	 */
	public function __construct( $key, $value = null )
	{
		$this->key    = $key;
		$this->value  = $value;
	}

	/**
	 * When this object is used as a string, just output the value.
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->value;
	}

	/**
	 * Get the key of the Inquiry.
	 * 
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * Get the value of the Inquiry.
	 * 
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Create a duplicate Inquiry, where the key and value are switched.
	 * Useful for decrypting complex names.
	 * 
	 * @return \Bycedroc\Inquiry\Inquiry
	 */
	public function swap()
	{
		return new static($this->value, $this->key);
	}

	/**
	 * Check if the query contains an array statement.
	 * 
	 * @return bool
	 */
	public function hasArray()
	{
		return ArrayQuery::validate($this->value);
	}

	/**
	 * Get the array value from the query.
	 * 
	 * @return array
	 */
	public function getArray()
	{
		return ArrayQuery::make($this->value);
	}

	/**
	 * Check if the query contains a relation statement.
	 * 
	 * @return bool
	 */
	public function hasRelation()
	{
		return RelationQuery::validate($this->value);
	}

	/**
	 * Get the relation data from the query.
	 * 
	 * @return \Bycedric\Inquiry\Queries\RelationQuery
	 */
	public function getRelation()
	{
		return RelationQuery::make($this->value);
	}

	/**
	 * Check if the query contains an operator statement.
	 * 
	 * @return bool
	 */
	public function hasOperator()
	{
		return OperatorQuery::validate($this->value);
	}

	/**
	 * Get the operator data from the query.
	 * 
	 * @return \Bycedric\Inquiry\Queries\OperatorQuery
	 */
	public function getOperator()
	{
		return OperatorQuery::make($this->value);
	}

	/**
	 * Check if the query contains an range statement.
	 * 
	 * @return bool
	 */
	public function hasRange()
	{
		return RangeQuery::validate($this->value);
	}

	/**
	 * Get the range data from the query.
	 * 
	 * @return \Bycedric\Inquiry\Queries\RangeQuery
	 */
	public function getRange()
	{
		return RangeQuery::make($this->value);
	}

}
