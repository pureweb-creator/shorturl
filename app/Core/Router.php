<?php

namespace App\Core;

/**
 * Router
 */
final class Router{
	public static function run(): void
    {
		$uri = array_filter(explode('/', $_SERVER['REQUEST_URI']));

		$controller_name = ucfirst($uri[2] ?? 'home')."Controller";
		$controller_method = $uri[3] ?? 'index';
		$controller_fullname = "App\Controllers\\$controller_name";

		if (!class_exists($controller_fullname)){
			http_response_code(404);
			die();
		}

		$controller = new $controller_fullname;
		$controller->$controller_method();
	}

	public static function getUrl(): string
    {
		return SITEURL;
	}
}