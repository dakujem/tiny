<?php


namespace Tiny\Test;

define('ROOT', __DIR__);

require_once __DIR__ . '/../vendor/autoload.php';

use Tracy\Debugger,
	Tester\Environment;

// tester
Environment::setup();

// debugging
Debugger::$strictMode = true;
Debugger::enable();
Debugger::$maxDepth = 10;
Debugger::$maxLen = 500;


// dump shortcut
function dump($var, $return = false)
{
	return Debugger::dump($var, $return);
}
