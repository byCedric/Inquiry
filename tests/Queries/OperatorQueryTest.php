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
	 * Test if no operator is still valid.
	 * 
	 * @return void
	 */
	public function testNoOperatorIsValid()
	{
		$this->assertTrue(OperatorQuery::validate('valid'));
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
	 * Test if the value is available
	 * 
	 * @return void
	 */
	public function testValueIsAvailable()
	{
		$query = OperatorQuery::make('=value');

		$this->assertSame('value', $query->getValue());
	}

	/**
	 * Test if the value can be NULL
	 * 
	 * @return void
	 */
	public function testValueCanBeNull()
	{
		$query = OperatorQuery::make('-');

		$this->assertNull($query->getValue());
	}

	/**
	 * Test if ->isNot returns true when not symbol was provided.
	 * 
	 * @return void
	 */
	public function testIsNotDetectsNotSymbol()
	{
		$query = OperatorQuery::make('!value');

		$this->assertTrue($query->isNot());
	}

	/**
	 * Test if ->isNot returns false when no not symbol was provided.
	 * 
	 * @return void
	 */
	public function testIsNotDetectsNotSymbolAndReturnsFalseWhenNotProvided()
	{
		$query = OperatorQuery::make('=value');

		$this->assertFalse($query->isNot());
	}

	/**
	 * Test if the defualt operator is equals, when no operator was supplied.
	 * 
	 * @return void
	 */
	public function testOperatorIsDefaultEquals()
	{
		$query = OperatorQuery::make('value');

		$this->assertSame('=', $query->getOperator());
	}

}
