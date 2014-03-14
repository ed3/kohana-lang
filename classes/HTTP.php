<?php defined('SYSPATH') OR die('No direct script access.');
class HTTP extends Kohana_HTTP {
	public static function redirect($uri = '', $code = 302) {
		$uri = Request::$lang.'/'.ltrim($uri, '/');
		parent::redirect($uri);
	}
}
