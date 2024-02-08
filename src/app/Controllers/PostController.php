<?php

namespace App\Controllers;

use Kernel\Http\Response;

class PostController
{
	public function index()
	{
		return new Response("posts page");
	}
	
	public function show($id)
	{
		return new Response("post with id {$id}");
	}
	
	
}