<?php 

return array(

	/*
	|--------------------------------------------------------------------------
	| Symbols
	|--------------------------------------------------------------------------
	|
	| The symbols for the syntax can be defined here.
	| By default, they are RFC 3986 compatible.
	|
	*/

	'symbols' => array(
		'relation' => ':',
		'array'    => ',',
		'equals'   => '=',
		'bigger'   => ']',
		'smaller'  => '[',
		'like'     => '~',
		'not'      => '!',
		'null'     => '-',
	),

	/*
	|--------------------------------------------------------------------------
	| (SQL) Methods
	|--------------------------------------------------------------------------
	|
	| The SQL method names can be defined here.
	| They should be "key"-ed by there symbol equivalent.
	|
	*/

	'methods' => array(
		'=' => '=',
		']' => '>',
		'[' => '<',
		'~' => 'LIKE',
		'!' => '<>',
	),

);
