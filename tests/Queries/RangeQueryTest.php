<?php

use Bycedric\Inquiry\Queries\RangeQuery;

class RangeQueryTest extends QueryTestCase {

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	public function testValidateSucceed()
	{
		$this->assertTrue(RangeQuery::validate('test|valid'));
	}

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	public function testValidateFails()
	{
		$this->assertFalse(RangeQuery::validate('testInvalid'));
	}

	/**
	 * Each Query object should be generatable from the ::make function.
	 * 
	 * @return void
	 */
	public function testMakeReturnsContent()
	{
		$this->assertInstanceOf(
			'\Bycedric\Inquiry\Queries\RangeQuery',
			RangeQuery::make('is|valid')
		);
	}

	/**
	 * Test if the values are being returned.
	 * 
	 * @return void
	 */
	public function testValuesIsAvailable()
	{
		$query = RangeQuery::make('is|<valid');

		$this->assertInternalType('array', $query->getValues());
	}

	/**
	 * Test if the values are instances of operator queries.
	 * 
	 * @return void
	 */
	public function testValuesAreInstancesOfOperatorQuery()
	{
		$query = RangeQuery::make('>is|valid');

		$this->assertContainsOnlyInstancesOf(
			'\Bycedric\Inquiry\Queries\OperatorQuery',
			$query->getValues()
		);
	}

	/**
	 * Test if the is all same operator can be true.
	 * 
	 * @return void
	 */
	public function testIsAllSameOperatorSucceeds()
	{
		$query = RangeQuery::make('is|same|operator');

		$this->assertTrue($query->isAllSameOperator('='));
	}

	/**
	 * Test if the is all same operator can be false.
	 * 
	 * @return void
	 */
	public function testIsAllSameOperatorFails()
	{
		$query = RangeQuery::make('>is|<make|>operator');

		$this->assertFalse($query->isAllSameOperator('>'));
	}

}
