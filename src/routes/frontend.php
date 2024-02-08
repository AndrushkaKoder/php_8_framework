<?php

use Kernel\Router\Route;
use App\Controllers\IndexController;

return [
	Route::get('/', [IndexController::class, 'index']),
	Route::get('/foo/{name}', function ($name) {
		return new \Kernel\Http\Response("hello {$name}");
	}),
	Route::post('/about', [\App\Controllers\IndexController::class, 'about']),
	Route::get('/posts', [\App\Controllers\PostController::class, 'index']),
	Route::get('/posts/post/{id}', [\App\Controllers\PostController::class, 'show']),
];
