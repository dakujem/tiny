<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/bootstrap.php';


/*

What I want to be able to do:

see readme.md

*/

class Foo extends \ArrayIterator {


}

$bar = [
	'a' => 1,
	'b' => 2,
	'c' => 3,
];
$foo = new Foo($bar);


dump($foo['a']);
dump($foo);

