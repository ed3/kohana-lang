<?php defined('SYSPATH') or die('No direct script access.');
class URL extends Kohana_URL {
	public static function site($uri = '', $protocol = FALSE, $lang = TRUE) {
		if ($lang === TRUE) {
			$uri = Request::$lang.'/'.ltrim($uri, '/');
		} elseif (is_string($lang)) {
			$uri = $lang.'/'.ltrim($uri, '/');
		}
		return parent::site($uri, $protocol);
	}
}
