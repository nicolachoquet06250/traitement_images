<?php

require_once __DIR__.'/vendor/autoload.php';

use ColorThief\ColorThief;
use ColorThief\Image\ImageLoader;

$sourceImage = 'https://i.ebayimg.com/images/g/k5cAAOSwNSxVeEJv/s-l300.jpg';

$dominantColor = ColorThief::getColor($sourceImage);
$palette = ColorThief::getPalette($sourceImage);

$image = new ImageLoader();
$image = $image->load($sourceImage);
$width = $image->getWidth();
$height = $image->getHeight();

echo 'images :';
for($i = 0; $i <= $height; $i++) {
	for($j = 0; $j <= $width; $j++) {
		$px = $image->getPixelColor($j, $i);
		echo '<div style="width: 1px; height: 1px; background-color: rgba('.$px->red.', '.$px->green.', '.$px->blue.', '.($px->alpha === 0 ? 1 : $px->alpha).'); display: inline-block;"></div>';
	}
	echo '<br>';
}

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