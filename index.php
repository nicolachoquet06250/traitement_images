<?php

require_once __DIR__.'/autoload.php';

use ColorThief\Extended\ColorThief;

function varDump(...$elems) {
	echo '<pre>';
	foreach ($elems as $elem) {
		var_dump($elem);
	}
	echo '</pre>';
}

$sourceImage = 'https://o1.ldh.be/image/thumb/59b9261fcd703b65924f0e26.jpg';

$dominantColor = ColorThief::getColor($sourceImage);
$palette = ColorThief::getPalette($sourceImage);
$image_to_pixels = ColorThief::getImageToPixels($sourceImage);

echo 'Image :';
echo ColorThief::getImageToHtmlPixels($sourceImage);

echo '<br>';
echo 'couleur dominante :';
echo '<div style="width: 20px; height: 20px; background-color: rgb('.$dominantColor[0].', '.$dominantColor[1].', '.$dominantColor[2].')"></div>';
echo '<br>';
echo 'palette de couleur dominante :';
echo '<br>';
$max_in_line = 3;
$cmp = 0;
foreach ($palette as $color) {
	echo '<div style="width: 20px; height: 20px; background-color: rgb('.$color[0].', '.$color[1].', '.$color[2].'); display: inline-block;"></div>';
	if($cmp < $max_in_line-1) {
		$cmp++;
	}
	else {
		$cmp = 0;
		echo '<br>';
	}
}