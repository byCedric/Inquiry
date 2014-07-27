<?php

use Bycedric\Inquiry\Queries\ArrayQuery;

class ArrayQueryTest extends QueryTestCase {

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	public function testValidateSucceed()
	{
		$this->assertTrue(ArrayQuery::validate('test,valid'));
	}

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	public function testValidateFails()
	{
		$this->assertFalse(ArrayQuery::validate('testInvalid'));
	}

	/**
	 * Each Query object should be generatable from the ::make function.
	 * 
	 * @return void
	 */
	public function testMakeReturnsContent()
	{
		$this->assertInternalType('array', ArrayQuery::make('is,valid'));
	}

}
