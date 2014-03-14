<?php defined('SYSPATH') or die('No direct script access.');
class Route extends Kohana_Route {
	public static function set($name, $uri = NULL, $regex = NULL) {
		$regex = array('lang'=>implode('|', array_keys(Kohana::$config->load('lang.languages'))));
		return Route::$_routes[$name] = new Route('(<lang>)(/)'.$uri, $regex);
	}
	public function defaults(array $defaults = NULL) {
		$default = array_merge(array('lang'=>Kohana::$config->load('lang.default')), $defaults);
		return parent::defaults($default);
	}
}
