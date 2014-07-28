<?php namespace Bycedric\Inquiry\Queries;

use Bycedric\Inquiry\Factory;
use Bycedric\Inquiry\Queries\Query;

class OperatorQuery extends Query {

	/**
	 * The operator character, defined by the given string.
	 * 
	 * @var string
	 */
	protected $operator;

	/**
	 * The (SQL) method name, for the operator.
	 * 
	 * @var string
	 */
	protected $method;

	/**
	 * The value to apply with the operator and method.
	 * 
	 * @var string
	 */
	protected $value;

	/**
	 * Parse the given string as an operator query.
	 * 
	 * @param string $string
	 */
	public function __construct( $string )
	{
		parent::__construct($string);

		$this->operator = Factory::syntax('symbols', 'equals', '=');
		$this->value    = $string;

		$operators = [
			Factory::syntax('symbols', 'equals', '='),
			Factory::syntax('symbols', 'bigger', ']'),
			Factory::syntax('symbols', 'smaller', '['),
			Factory::syntax('symbols', 'like', '~'),
		];

		if( in_array($string[0], $operators) )
		{
			$this->operator = $string[0];
			$this->value    = substr($string, 1);
		}

		$this->method = $this->getMethodFromOperator($this->operator);
	}

	/**
	 * Get the method name from the operator.
	 * 
	 * @param  string $operator 
	 * @return string
	 */
	protected function getMethodFromOperator( $operator )
	{
		if( $operator == Factory::syntax('symbols', 'bigger', ']') )
		{
			return Factory::syntax('methods', $operator, '>');
		}

		if( $operator == Factory::syntax('symbols', 'smaller', '[') )
		{
			return Factory::syntax('methods', $operator, '<');
		}

		if( $operator == Factory::syntax('symbols', 'like', '~') )
		{
			return Factory::syntax('methods', $operator, 'LIKE');
		}

		return Factory::syntax('methods', $operator, '=');
	}

	/**
	 * Get the operator character from the string.
	 * 
	 * @return string
	 */
	public function getOperator()
	{
		return $this->operator;
	}

	/**
	 * Get the (SQL) method name from the operator.
	 * 
	 * @return string
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Get the value to apply with the operator.
	 * 
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * Make a operator query from the given string.
	 * 
	 * @param  string $string
	 * @return \Bycedric\Inquiry\Queries\OperatorQuery
	 */
	public static function make( $string )
	{
		return new static($string);
	}

	/**
	 * Check if the given string is a valid operator query.
	 * 
	 * @param  string $string
	 * @return bool
	 */
	public static function validate( $string )
	{
		return !!(ctype_alnum((string) $string[0]) || in_array((string) $string[0], [
			Factory::syntax('symbols', 'equals', '='),
			Factory::syntax('symbols', 'bigger', ']'),
			Factory::syntax('symbols', 'smaller', '['),
			Factory::syntax('symbols', 'like', '~'),
		]));
	}

}
