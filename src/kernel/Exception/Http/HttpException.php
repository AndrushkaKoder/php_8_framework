<?php

namespace Kernel\Exception\Http;

class HttpException extends \Exception
{
	private int $statusCode = 200;
	
	public function setStatusCode(int $code): static
	{
		$this->statusCode = $code;
		return $this;
	}
	
	public function getStatusCode(): int
	{
		return $this->statusCode;
	}
}