<?php


namespace ColorThief\Extended;


class Pixel {
	protected $red;
	protected $green;
	protected $blue;
	protected $alpha;

	public function __construct($red, $green, $blue, $alpha = 1) {
		$this->set_red($red);
		$this->set_green($green);
		$this->set_blue($blue);
		$this->set_alpha($alpha);
	}

	public function get_red() {
		return $this->red;
	}

	public function get_green() {
		return $this->green;
	}

	public function get_blue() {
		return $this->blue;
	}

	public function get_alpha() {
		return $this->alpha === 0 ? 1 : $this->alpha;
	}

	protected function set_red($red) {
		$this->red = $red;
		return $this;
	}

	protected function set_green($green) {
		$this->green = $green;
		return $this;
	}

	protected function set_blue($blue) {
		$this->blue = $blue;
		return $this;
	}

	public function set_alpha($alpha) {
		$this->alpha = $alpha;
		return $this;
	}
}