<?php namespace Bycedric\Inquiry\Queries;

use Bycedric\Inquiry\Factory;
use Bycedric\Inquiry\Queries\Query;

class RangeQuery extends Query {

	/**
	 * The array containing all OperatorQuery values.
	 * 
	 * @var array
	 */
	protected $values = [];

	/**
	 * Parse the given string as an range query.
	 * 
	 * @param string $string
	 */
	public function __construct( $string )
	{
		parent::__construct($string);

		$values = explode(Factory::syntax('symbols', 'delim', '|'), $string);

		foreach( $values as $value )
		{
			$this->values[] = OperatorQuery::make($value);
		}
	}

	/**
	 * Get all values within this range query.
	 * 
	 * @return array
	 */
	public function getValues()
	{
		return $this->values;
	}

	/**
	 * Check if all the values are from the same operator.
	 * 
	 * @param  string  $operator
	 * @return boolean
	 */
	public function isAllSameOperator( $operator )
	{
		$same = true;

		foreach( $this->values as $value )
		{
			if( $value->getOperator() !== $operator )
			{
				$same = false;
				break;
			}
		}

		return $same;
	}

	/**
	 * Make an range query from the given string.
	 * 
	 * @param  string $string
	 * @return \Bycedric\Inquiry\Queries\RangeQuery
	 */
	public static function make( $string )
	{
		return new static($string);
	}

	/**
	 * Check if the given string is a valid range query.
	 * 
	 * @param  string $string
	 * @return bool
	 */
	public static function validate( $string )
	{
		return !!strpos($string, Factory::syntax('symbols', 'delim', '|'));
	}

}
