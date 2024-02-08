<?php

namespace Kernel\Http;

use Kernel\Exception\Http\HttpException;
use Kernel\Router\Router;

class Kernel
{
	public function __construct(private Router $router)
	{
	}
	
	public function handle(Request $request)
	{
		try {
			[$routeHandler, $args] = $this->router->dispatch($request);
			$response = call_user_func_array($routeHandler, $args);
		} catch (HttpException $exception) {
			$response = new Response($exception->getMessage(), $exception->getStatusCode());
		}
		return $response;
	}
}