<?php

require __DIR__ . '/hello.php';

function assertTrue($condition)
{
	if (!$condition)
	{
		throw new Exception('Assetion faild.');
	}
}

$test = hello();
$expected = 'Hello World!';
assertTrue($test === $expected);
