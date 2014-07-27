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

}