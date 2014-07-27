<?php namespace Bycedric\Inquiry\Queries;

use Bycedric\Inquiry\Contracts\Queryable;

abstract class Query implements Queryable {

	/**
	 * The given string.
	 * 
	 * @var string
	 */
	protected $raw;

	/**
	 * Store the string as raw, for toString convertion.
	 * 
	 * @param string $string
	 */
	public function __construct( $string )
	{
		$this->raw = $string;
	}

	/**
	 * Output the given string when the object is used as string.
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->raw;
	}

}
