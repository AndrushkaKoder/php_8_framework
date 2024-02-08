<?php

namespace Kernel\Router;

class Route
{
	public function __construct(
		public string $method,
		public string $uri,
		public array  $handler,
		public array  $middleware = [],
	)
	{
	
	}
	
	public static function get(string $uri, array|callable $handler, array $middleware = []): array
	{
		return ['GET', $uri, $handler];
	}
	
	public static function post(string $uri, array|callable $handler, array $middleware = []): array
	{
		return ['POST', $uri, $handler];
	}
}