<?php namespace Bycedric\Inquiry;

use stdClass;
use Bycedric\Inquiry\Factory;

class Entity {

	/**
	 * The parent Inquiry object.
	 * 
	 * @var \Bycedric\Inquiry\Factory
	 */
	protected $factory;

	/**
	 * All variables of this Entity, stored in an array.
	 * 
	 * @var array
	 */
	protected $variables = [];

	/**
	 * Set the main variables, parent, name and value.
	 * Then allow extra values to be set using an array.
	 * Note, name and value keys are overwriten by the parameters.
	 *
	 * @param \Bycedric\Inquiry\Inquiry $parent
	 * @param string $name
	 * @param mixed  $value (default: null)
	 * @param array  $extra
	 */
	public function __construct( Factory $factory, $name, $value, array $extra = array() )
	{
		$this->factory = $factory;
		$this->variables = array_merge([ 'primary' => 'value' ], $extra, [ 'name'  => $name, 'value' => $value]);
	}

	/**
	 * Get the "primary" variable, it's most likely to be the name or value.
	 * If another was given, use that one if it exists.
	 * 
	 * @param  string $variable (default: null)
	 * @return sring
	 */
	protected function getPrimaryVariable( $variable = null )
	{
		if( empty($variable) || !array_key_exists($variable, $this->variables) )
			return $this->variables['primary'];

		return $variable;
	}

	/**
	 * Get the "primary" variable's value.
	 * 
	 * @param  string $variable (default: null)
	 * @return sring
	 */
	protected function getPrimaryValue( $variable = null )
	{
		return $this->get($this->getPrimaryVariable($variable));
	}

	/**
	 * Get a symbol, by name.
	 * 
	 * @param  string $name
	 * @return string
	 */
	protected function getSymbol( $name )
	{
		return $this->factory->getSymbols()[$name];
	}

	/**
	 * Get a method, by operator.
	 * 
	 * @param  string $name
	 * @return string
	 */
	protected function getMethod( $operator )
	{
		return $this->factory->getMethods()[$operator];
	}

	/**
	 * Get the given variable name.
	 * 
	 * @param  string $variable
	 * @param  mixed  $default (default: null)
	 * @return mixed
	 */
	public function get( $variable, $default = null )
	{
		if( array_key_exists($variable, $this->variables) )
			return $this->variables[$variable];

		return $default;
	}

	/**
	 * Check if the given variable contains an relation.
	 * 
	 * @param  string  $variable (default: null)
	 * @return boolean
	 */
	public function hasRelation( $variable = null )
	{
		return !(strpos($this->getPrimaryValue($variable), $this->getSymbol('relation')) !== false);
	}

	/**
	 * Get the given variable as a relation object.
	 * 
	 * @param  string $variable (default: null)
	 * @return stdClass
	 */
	public function getRelation( $variable = null )
	{
		$obj  = new stdClass();

		list($relation, $name) = explode($this->getSymbol('relation'), $this->getPrimaryValue($variable));

		// $relation = UriSyntax::singular($relation);
		
		$obj->relation = $this->factory->camelCase($relation);
		$obj->name     = $this->factory->lowerCase($this->factory->snakeCase($name));

		return $obj;
	}

	/**
	 * Check if the given variable contains an array.
	 * 
	 * @param  string  $variable (default: null)
	 * @return boolean
	 */
	public function hasArray( $variable = null )
	{
		return !(strpos($this->getPrimaryValue($variable), $this->getSymbol('array')) !== false);
	}

	/**
	 * Get the given variable as an array.
	 * 
	 * @param  string $variable (default: null)
	 * @return array
	 */
	public function getArray( $variable = null )
	{
		return explode($this->getSymbol('array'), $this->factory->lowerCase($this->getPrimaryValue($variable)));
	}

	/**
	 * Check if the given variable contains an array.
	 * 
	 * @param  string  $variable (default: null)
	 * @return boolean
	 */
	public function hasOperator( $variable = null )
	{
		$value = $this->getPrimaryValue($variable);

		if( !empty($value) && is_string($value) )
			return in_array($value[0], array_keys($this->factory->getMethods()));

		return false;
	}

	/**
	 * Get the given focus variable as an operator object.
	 * 
	 * @param  string $focus (default: null)
	 * @param  mixed  $default (defualt: =)
	 * @return string
	 */
	public function getOperator( $focus = null, $default = '=' )
	{
		$obj = new stdClass();
		$obj->operator = $default;
		$obj->method   = $this->getMethod($obj->operator);
		$obj->value    = $this->getPrimaryValue($focus);

		if( $this->hasOperator($focus) ){
			$obj->operator = $obj->value[0];
			$obj->method   = $this->getMethod($obj->operator);
			$obj->value    = $this->factory->lowerCase(substr($obj->value, 1));
		}
		
		return $obj;
	}

	/**
	 * Shortcut to just use the getters as variable syntax.
	 * 
	 * @param  string $name
	 * @return mixed
	 */
	public function __get( $name )
	{
		if( method_exists($this, 'get'. $this->factory->camelCase($name)) )
			return $this->{'get'. $this->factory->camelCase($name)}();

		return $this->get($name);
	}

	/**
	 * When this class is used within a string, return the focused value.
	 * 
	 * @return mixed
	 */
	public function __toString()
	{
		return $this->getPrimaryValue();
	}

}