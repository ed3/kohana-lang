<?php defined('SYSPATH') or die('No direct script access.');
class Request extends Kohana_Request {
        static public $lang = '';
        public static function factory($uri = TRUE, $client_params = array(), $allow_external = TRUE, $injected_routes = array())
        {
                if($uri === TRUE) {
                        $uri = Request::detect_uri();
                }
                $uri = ltrim($uri, '/');
                $cfg = Kohana::$config->load('lang');
                preg_match('~^(?:'.implode('|', array_keys($cfg['languages'])).')(?=/|$)~i', $uri, $matches);
                if(empty($matches)){
                        I18n::$lang = $cfg['languages'][$cfg['default']]['i18n_code'];
                        setlocale(LC_ALL, $cfg['languages'][$cfg['default']]['locale']);
                        return parent::factory($cfg['default'].'/'.$uri, $client_params, $allow_external, $injected_routes);
                }
                Request::$lang = strtolower(arr::get($matches,0,$cfg['default']));
                I18n::$lang = $cfg['languages'][Request::$lang]['i18n_code'];
                setlocale(LC_ALL, $cfg['languages'][Request::$lang]['locale']);
                $uri = preg_replace("/^".Request::$lang."\/|^".Request::$lang."$/", '\\0', $uri);
                return parent::factory($uri, $client_params, $allow_external, $injected_routes);
        }
}
