<?php

use Bycedric\Inquiry\Factory;

abstract class TestCase extends PHPUnit_Framework_TestCase {

	/**
	 * Mockery should always be closed when a test is teared down.
	 * Also, reset the factory syntax.
	 * 
	 * @return void
	 */
	public function tearDown()
	{
		Mockery::close();
		Factory::$SYNTAX = [];
	}

	/**
	 * Call protected/private method of a class.
	 *
	 * @see https://jtreminio.com/2013/03/unit-testing-tutorial-part-3-testing-protected-private-methods-coverage-reports-and-crap/
	 * @param object &$object    Instantiated object that we will run method on.
	 * @param string $methodName Method name to call
	 * @param array  $parameters Array of parameters to pass into method.
	 * @return mixed Method return.
	 */
	public function invokeMethod( &$object, $methodName, array $parameters = array() )
	{
		$reflection = new ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}

}