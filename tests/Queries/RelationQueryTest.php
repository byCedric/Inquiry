<?php

use Bycedric\Inquiry\Queries\RelationQuery;

class RelationQueryTest extends QueryTestCase {

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	public function testValidateSucceed()
	{
		$this->assertTrue(RelationQuery::validate('test:valid'));
	}

	/**
	 * Each Query object must be validatable.
	 * 
	 * @return void
	 */
	public function testValidateFails()
	{
		$this->assertFalse(RelationQuery::validate('testInvalid'));
	}

	/**
	 * Each Query object should be generatable from the ::make function.
	 * 
	 * @return void
	 */
	public function testMakeReturnsContent()
	{
		$this->assertInstanceOf(
			'\Bycedric\Inquiry\Queries\RelationQuery',
			RelationQuery::make('is:valid')
		);
	}

	/**
	 * Test if the relation is available.
	 * 
	 * @return void
	 */
	public function testRelationIsAvailable()
	{
		$query = RelationQuery::make('relation:value');

		$this->assertSame('relation', $query->getRelated());
	}

	public function testValueIsAvailable()
	{
		$query = RelationQuery::make('relation:value');

		$this->assertSame('value', $query->getValue());
	}

}
