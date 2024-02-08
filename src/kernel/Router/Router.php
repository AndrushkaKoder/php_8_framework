<?php

namespace Kernel\Router;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Kernel\Exception\Http\MethodNotAllowedException;
use Kernel\Exception\Http\RouteNotFoundException;
use Kernel\Http\Request;
use function FastRoute\simpleDispatcher;

class Router
{
	public function dispatch(Request $request): ?array
	{
		$dispatcher = simpleDispatcher(function (RouteCollector $collector) {
			$routes = $this->getRoutes();
			foreach ($routes as $route) {
				$collector->addRoute(...$route);
			}
		});
		
		$info = $dispatcher->dispatch(
			$request->getHttpMethod(),
			$request->getUri()
		);
		
		switch ($info[0]) {
			case Dispatcher::NOT_FOUND:
				
				$exception = new RouteNotFoundException('route not found!');
				$exception->setStatusCode(404);
				throw $exception;
			
			case Dispatcher::METHOD_NOT_ALLOWED:
				
				$message = "Supported HTTP methods: " . implode(',', $info[1]);
				$exception = new MethodNotAllowedException($message);
				$exception->setStatusCode(405);
				throw $exception;
			
			case Dispatcher::FOUND:
				return $this->routeHandle($info);
		}
		return null;
	}
	
	private function routeHandle(array $routeInfo): array
	{
		if (is_array($routeInfo[1])) {
			[$status, [$controller, $action], $args] = $routeInfo;
			if (!method_exists($controller, $action)) {
				throw new RouteNotFoundException('method not found in Controller', 500);
			}
			return [[new $controller(), $action], $args];
		} else {
			[$status, $callback, $args] = $routeInfo;
			return [$callback, $args];
		}
	}
	
	private function pageNotFound()
	{
		http_response_code(404);
		die(include_once VIEWS . '/404/404.php');
	}
	
	private function getRoutes(): array
	{
		return array_merge(
			(include_once ROUTES . '/admin.php'),
			(include_once ROUTES . '/frontend.php'),
			(include_once ROUTES . '/api.php'),
		);
	}
}