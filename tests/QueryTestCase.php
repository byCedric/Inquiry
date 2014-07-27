<?php

abstract class QueryTestCase extends TestCase {

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	abstract public function testValidateSucceed();

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	abstract public function testValidateFails();

	/**
	 * Each Query object should be generatable from the ::make function.
	 * 
	 * @return void
	 */
	abstract public function testMakeReturnsContent();

}