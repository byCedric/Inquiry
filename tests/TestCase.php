<?php

abstract class TestCase extends PHPUnit_Framework_TestCase {

	/**
	 * Mockery should always be closed when a test is teared down.
	 * 
	 * @return void
	 */
	public function tearDown()
	{
		Mockery::close();
	}

}