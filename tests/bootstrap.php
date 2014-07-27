<?php

/*
|--------------------------------------------------------------------------
| Autoload
|--------------------------------------------------------------------------
|
| This package is installed through composer, using the composer.json file.
| It also manages the autoloading of all necessary files and classes.
| So let's include that first.
|
*/

require_once __DIR__ .'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The TestCase class functions as the default test class.
| Within there you can define the basic, shared, functions.
| It is named after the Laravel TestCase class.
|
*/

require_once __DIR__ .'/TestCase.php';

/*
|--------------------------------------------------------------------------
| Query Test Case
|--------------------------------------------------------------------------
|
| Because every query is actually almost the same, we have created
| a default class with default tests that should pass for each query.
|
*/

require_once __DIR__ .'/QueryTestCase.php';
