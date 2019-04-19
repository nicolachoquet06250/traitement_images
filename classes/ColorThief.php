<?php


namespace ColorThief\Extended;


use ColorThief\Image\ImageLoader;

class ColorThief extends \ColorThief\ColorThief {
	private static $width_palette_px = 20;
	private static $width_image_px = 1;

	/**
	 * @param string $source
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

	/**
	 * @param string $source
	 * @return string
	 */
	public static function getImageToHtmlPixels($source) {
		$image_to_pixels = self::getImageToPixels($source);
		$image = '<picture style="display: block; width: '.(count($image_to_pixels[0]) * self::$width_image_px).'px;">';
		foreach ($image_to_pixels as $image_line) {
			$image .= '<pixels-line style="display: block;">';
			foreach ($image_line as $px) {
				$image .= '<pixel style="display: inline-block; width: '.self::$width_image_px.'px; height: '.self::$width_image_px.'px; background-color: rgba('.$px->get_red().', '.$px->get_green().', '.$px->get_blue().', '.$px->get_alpha().')"></pixel>';
			}
			$image .= '</pixels-line>';
		}
		$image .= '</picture>';

		return $image;
	}

	/**
	 * @param string     $sourceImage
	 * @param int        $quality
	 * @param array|null $area
	 * @return Pixel
	 */
	public static function getColor($sourceImage, $quality = 10, array $area = null) {
		$palette = parent::getPalette($sourceImage, 5, $quality, $area);
		$color = $palette ? $palette[0] : false;
		return new Pixel($color[0], $color[1], $color[2]);
	}

	/**
	 * @param mixed      $sourceImage
	 * @param int        $colorCount
	 * @param int        $quality
	 * @param array|null $area
	 * @param int        $max_in_line
	 * @return Pixel[][]
	 */
	public static function getPalette($sourceImage, $colorCount = 10, $quality = 10, array $area = null, $max_in_line = 3) {
		$palette = parent::getPalette($sourceImage, $colorCount, $quality, $area);
		$_palette = [];

		$cmp = 0;
		$total_cmp = 0;
		while (count($palette) >= $max_in_line) {
			$_palette[$cmp] = [];
			for($i = 0; $i < $max_in_line; $i++) {
				$_palette[$cmp][] = new Pixel($palette[$total_cmp][0], $palette[$total_cmp][1], $palette[$total_cmp][2]);
				unset($palette[$total_cmp]);
				$total_cmp++;
			}
			$cmp++;
		}

		return $_palette;
	}

	public static function getPaletteToHtmlPixels($source, $max_in_line = 3) {
		$palette = self::getPalette($source, 10, 10, null, $max_in_line);
		$html = '<palette style="display: block; width: '.($max_in_line * self::$width_palette_px).'px">';
		foreach ($palette as $line) {
			$html .= '<palette-line style="display: block;">';
			foreach ($line as $pixel) {
				$html .= '<color style="display: inline-block; width: '.self::$width_palette_px.'px; height: '.self::$width_palette_px.'px; background-color: rgb('.$pixel->get_red().', '.$pixel->get_green().', '.$pixel->get_blue().')"></color>';
			}
			$html .= '</palette-line>';
		}
		$html .= '</palette>';
		return $html;
	}
}