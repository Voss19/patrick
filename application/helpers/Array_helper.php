<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function moveArrayElement(&$array, $a, $b)
{
	$out = array_splice($array, $a, 1);
	array_splice($array, $b, 0, $out);
}

function addUrlArray(&$array, $s, $url)
{
	foreach ($array as $key => $value) {
		$array[$key][$s] = $url.$value[$s];
	}
}