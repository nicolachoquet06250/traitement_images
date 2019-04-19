<?php


namespace ColorThief\Extended;


use ColorThief\Image\ImageLoader;

class ColorThief extends \ColorThief\ColorThief {
	/**
	 * @param $source
	 * @return Pixel[][]
	 */
	public static function getImageToPixels($source) {
		$image = new ImageLoader();
		$image = $image->load($source);

		$width = $image->getWidth();
		$height = $image->getHeight();

		$image_to_pixels = [];

		for($i = 0; $i < $height; $i++) {
			$line = [];
			for($j = 0; $j < $width; $j++) {
				$px = $image->getPixelColor($j, $i);
				$line[] = new Pixel($px->red, $px->green, $px->blue, $px->alpha);
			}
			$image_to_pixels[] = $line;
		}
		return $image_to_pixels;
	}
}