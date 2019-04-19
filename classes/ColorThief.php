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

	public static function getImageToHtmlPixels($source) {
		$image_to_pixels = self::getImageToPixels($source);
		$image = '<picture style="display: block; width: '.count($image_to_pixels[0]).'px;">';
		foreach ($image_to_pixels as $image_line) {
			$image .= '<pixels-line style="display: block;">';
			foreach ($image_line as $px) {
				$image .= '<pixel style="display: inline-block; width: 1px; height: 1px; background-color: rgba('.$px->get_red().', '.$px->get_green().', '.$px->get_blue().', '.$px->get_alpha().')"></pixel>';
			}
			$image .= '</pixels-line>';
		}
		$image .= '</picture>';

		return $image;
	}
}