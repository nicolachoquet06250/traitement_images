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
echo '<div style="width: 20px; height: 20px; background-color: rgb('.$dominantColor->get_red().', '.$dominantColor->get_green().', '.$dominantColor->get_blue().')"></div>';
echo '<br>';
echo 'palette de couleur dominante :';
echo '<br>';
echo ColorThief::getPaletteToHtmlPixels($sourceImage);