<?php

use Bycedric\Inquiry\Queries\OperatorQuery;

class OperatorQueryTest extends QueryTestCase {

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	public function testValidateSucceed()
	{
		$this->assertTrue(OperatorQuery::validate('=valid'));
	}

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	public function testValidateFails()
	{
		$this->assertFalse(OperatorQuery::validate('#invalid'));
	}

	/**
	 * Check if the getMethodFromOperator acutally returns anything.
	 * 
	 * @return void
	 */
	public function testGetMethodFromOperatorReturnsValue()
	{
		$query  = OperatorQuery::make(']value');
		$method = $this->invokeMethod($query, 'getMethodFromOperator', [']']);

		$this->assertSame('>', $method);
	}

	/**
	 * Each Query object should be generatable from the ::make function.
	 * 
	 * @return void
	 */
	public function testMakeReturnsContent()
	{
		$this->assertInstanceOf(
			'\Bycedric\Inquiry\Queries\OperatorQuery',
			OperatorQuery::make('=valid')
		);
	}

	/**
	 * Test if the operator is available.
	 * 
	 * @return void
	 */
	public function testOperatorIsAvailable()
	{
		$query = OperatorQuery::make('=value');

		$this->assertSame('=', $query->getOperator());
	}

	/**
	 * Test if the method is available.
	 * 
	 * @return void
	 */
	public function testMethodIsAvailable()
	{
		$query = OperatorQuery::make('=value');

		$this->assertInternalType('string', $query->getMethod());
	}

	/**
	 * Test if the value is is available
	 * 
	 * @return void
	 */
	public function testValueIsAvailable()
	{
		$query = OperatorQuery::make('=value');

		$this->assertSame('value', $query->getValue());
	}

}
