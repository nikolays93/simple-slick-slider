<?php

namespace SimpleSlickSlider;

abstract class Registrator {

	abstract public function register();
	public static function get_name() {
		return apply_filters( __CLASS__ . '::name', static::DEFAULT_NAME );
	}
}
