<?php

use Bycedric\Inquiry\Factory;

class FactoryTest extends TestCase {

	/**
	 * Get a Request Mock instance.
	 * 
	 * @return \Mockery\Mock
	 */
	private function getRequest()
	{
		return Mockery::mock('\Illuminate\Http\Request');
	}

	/**
	 * Get a new Factory instance.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Bycedric\Inquiry\Factory
	 */
	private function getFactory( $request )
	{
		return new Factory($request);
	}

	/**
	 * Test if the static syntax method returns a syntax value.
	 * 
	 * @return void
	 */
	public function testSyntaxReturnsValue()
	{
		Factory::$SYNTAX['symbols'] = ['equals' => '='];

		$this->assertInternalType('string', Factory::syntax('symbols', 'equals'));
	}

	/**
	 * Test if the static syntax method returns the default value if an unknown syntax is requested.
	 * 
	 * @return void
	 */
	public function testSyntaxReturnsDefaultWhenKeyIsNotDefined()
	{
		$this->assertSame('unknown', Factory::syntax('symbols', 'what??', 'unknown'));
	}

	/**
	 * Test if the Factory's ->has function can return true.
	 * 
	 * @return void
	 */
	public function testHasCanReturnTrue()
	{	
		$request = $this->getRequest();
		$request
			->shouldReceive('has')
			->once()
			->andReturn(true);

		$this->assertTrue($this->getFactory($request)->has('test'));
	}

	/**
	 * Test if the Factory's ->has function can return false.
	 * 
	 * @return void
	 */
	public function testHasCanReturnFalse()
	{
		$request = $this->getRequest();
		$request
			->shouldReceive('has')
			->once()
			->andReturn(false);

		$this->assertFalse($this->getFactory($request)->has('test'));
	}
	
	/**
	 * Test if the ->get function returns an Inquiry.
	 * 
	 * @return void
	 */
	public function testGetReturnsInquiryObject()
	{
		$request = $this->getRequest();
		$request
			->shouldReceive('input')
			->once()
			->andReturn('value');

		$factory = $this->getFactory($request);
		$result  = $factory->get('test');

		$this->assertInstanceOf('\Bycedric\Inquiry\Inquiry', $result);
		$this->assertSame('value', (string) $result);
	}

	/**
	 * Test if the ->get function returns the default value,
	 * when the requested query does not exists.
	 * 
	 * @return void
	 */
	public function testGetReturnsDefaultWhenKeyIsNotDefined()
	{
		$request = $this->getRequest();
		$request
			->shouldReceive('input')
			->once()
			->andReturn('default value');

		$factory = $this->getFactory($request);
		$result  = $factory->get('key', 'default value');

		$this->assertInternalType('string', $result);
		$this->assertSame('default value', $result);
	}

	/**
	 * Test if the ->all function returns an array of Inquiry objects.
	 * 
	 * @return void
	 */
	public function testAllReturnsArrayOfInquiryObjects()
	{
		$request = $this->getRequest();
		$request
			->shouldReceive('all')
			->once()
			->andReturn([
				'1attribute' => 'value',
				'2attribute' => 'other value',
				'3that'      => 'asd'
			]);

		$factory = $this->getFactory($request);
		$result  = $factory->all();

		$this->assertContainsOnlyInstancesOf('\Bycedric\Inquiry\Inquiry', $result);
	}

	/**
	 * Test if the ->only function returns an array of Inquiry objects.
	 * 
	 * @return void
	 */
	public function testOnlyReturnsArrayOfInquiryObjects()
	{
		$request = $this->getRequest();
		$request
			->shouldReceive('only')
			->once()
			->andReturn([
				'1attribute' => 'value',
				'2attribute' => 'other value',
				'3that'      => 'asd'
			]);

		$factory = $this->getFactory($request);
		$result  = $factory->only([
			'no'     => 'influence',
			'tested' => 'inRequest',
		]);

		$this->assertContainsOnlyInstancesOf('\Bycedric\Inquiry\Inquiry', $result);
	}

	/**
	 * test if the ->except function returns an array of Inquiry objects.
	 * 
	 * @return void
	 */
	public function testExceptReturnsArrayOfInquiryObjects()
	{
		$request = $this->getRequest();
		$request
			->shouldReceive('except')
			->once()
			->andReturn([
				'1attribute' => 'value',
				'2attribute' => 'other value',
				'3that'      => 'asd'
			]);

		$factory = $this->getFactory($request);
		$result  = $factory->except([
			'no'     => 'influence',
			'tested' => 'inRequest',
		]);

		$this->assertContainsOnlyInstancesOf('\Bycedric\Inquiry\Inquiry', $result);
	}

}