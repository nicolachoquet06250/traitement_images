<?php

require_once __DIR__.'/vendor/autoload.php';

$dir = opendir(__DIR__.'/classes');
while (($elem = readdir($dir)) !== false) {
	if($elem !== '.' && $elem !== '..') {
		if(is_file(__DIR__.'/classes/'.$elem)) {
			require_once __DIR__.'/classes/'.$elem;
		}
	}
}