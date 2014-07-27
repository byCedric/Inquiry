<?php

use Bycedric\Inquiry\Inquiry;
use Bycedric\Inquiry\Queries\ArrayQuery;
use Bycedric\Inquiry\Queries\RelationQuery;
use Bycedric\Inquiry\Queries\OperatorQuery;

class InquiryTest extends TestCase {

	/**
	 * Test if the Inquiry object is castable to a string.
	 * 
	 * @return void
	 */
	public function testCastableToString()
	{
		$query = new Inquiry('key', 'value');

		$this->assertInternalType('string', (string) $query);
		$this->assertEquals('value', (string) $query);
	}

	/**
	 * Test if a new instance is created when swapping the values.
	 * 
	 * @return void
	 */
	public function testSwapCreatesNewInstance()
	{
		$query   = new Inquiry('key', 'value');
		$swapped = $query->swap();

		$this->assertNotEquals($query, $swapped);
		$this->assertInstanceOf('\Bycedric\Inquiry\Inquiry', $query);
		$this->assertInstanceOf('\Bycedric\Inquiry\Inquiry', $swapped);
	}

	/**
	 * Test if the key and values are swapped when swapping.
	 * 
	 * @return void
	 */
	public function testSwapSwapsKeyAndValue()
	{
		$query = (new Inquiry('key', 'value'))->swap();

		$this->assertSame('key', (string) $query);
	}

	/**
	 * Test if the ->hasArray function returns the same as the ArrayQuery object.
	 * 
	 * @return void
	 */
	public function testHasArrayReturnsArrayQueryValue()
	{
		$valid   = 'is,valid';
		$invalid = 'is,invalid';
		
		$this->assertEquals(ArrayQuery::validate($valid), (new Inquiry('key', $valid))->hasArray());
		$this->assertEquals(ArrayQuery::validate($invalid), (new Inquiry('key', $invalid))->hasArray());
	}

	/**
	 * Test if the ->getArray function returns the same as the ArrayQuery object.
	 * 
	 * @return void
	 */
	public function testGetArrayReturnsArrayQueryValue()
	{
		$query = 'is,valid';

		$this->assertEquals(ArrayQuery::make($query), (new Inquiry('key', $query))->getArray());
	}

	/**
	 * Test if the ->hasRelation function returns boolean.
	 * 
	 * @return void
	 */
	public function testHasRelationReturnsRelationQueryValue()
	{
		$valid   = 'valid:relation';
		$invalid = 'invalidRelation';
		
		$this->assertEquals(RelationQuery::validate($valid), (new Inquiry('key', $valid))->hasRelation());
		$this->assertEquals(RelationQuery::validate($invalid), (new Inquiry('key', $invalid))->hasRelation());
	}

	/**
	 * Test if the ->getRelation function returns the same as the RelationQuery object.
	 * 
	 * @return void
	 */
	public function testGetRelationReturnsRelationQueryValue()
	{
		$query = 'valid:relation';

		$this->assertEquals(RelationQuery::make($query), (new Inquiry('key', $query))->getRelation());
	}

	/**
	 * Test if the ->hasOperator function returns boolean.
	 * 
	 * @return void
	 */
	public function testHasOperatorReturnsOperatorQueryValue()
	{
		$valid   = '=valid';
		$invalid = '#invalid';
		
		$this->assertEquals(OperatorQuery::validate($valid), (new Inquiry('key', $valid))->hasOperator());
		$this->assertEquals(OperatorQuery::validate($invalid), (new Inquiry('key', $invalid))->hasOperator());
	}

	/**
	 * Test if the ->getRelation function returns the same as the RelationQuery object.
	 * 
	 * @return void
	 */
	public function testGetOperatorReturnsOperatorQueryValue()
	{
		$query = '=valid';

		$this->assertEquals(OperatorQuery::make($query), (new Inquiry('key', $query))->getOperator());
	}

}
