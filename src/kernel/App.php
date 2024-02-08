<?php

namespace Kernel;

use Kernel\Http\Kernel;
use Kernel\Http\Request;
use Kernel\Router\Router;

final class App
{
	public function run()
	{
		$request = Request::createFromGlobals();
		$router = new Router();
		$response = (new Kernel($router))->handle($request);
		
		dump($response->send());
	}
}