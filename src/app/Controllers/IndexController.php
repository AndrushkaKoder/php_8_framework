<?php

namespace App\Controllers;

use Kernel\Controller\BaseController;
use Kernel\Http\Response;

class IndexController extends BaseController
{
	public function index()
	{
		return new Response('index method');
		
	}
	
	public function about()
	{
		return new Response("about page");
	}
	
}