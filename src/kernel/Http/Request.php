<?php

namespace Kernel\Http;

class Request
{
	public function __construct(
		private array $get,
		private array $post,
		private array $cookies,
		private array $session,
		private array $files,
		private readonly array $server
	)
	{
	
	}
	
	public static function createFromGlobals(): static
	{
		return new static(
			$_GET,
			$_POST,
			$_COOKIE,
			$_SESSION,
			$_FILES,
			$_SERVER
		);
	}
	
	public function getHttpMethod(): string
	{
		return $this->server['REQUEST_METHOD'];
	}
	
	public function getUri(): string
	{
		return preg_replace('/\?+.*/', '', $this->server['REQUEST_URI']);
	}
	
}