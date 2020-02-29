<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/books','BooksController@index');
$router->post('/books','BooksController@store');
$router->get('/books/{book}','BooksController@show');
$router->put('/books/{book}','BooksController@update');
$router->patch('/books/{book}','BooksController@update');
$router->delete('/books/{book}','BooksController@destroy');
