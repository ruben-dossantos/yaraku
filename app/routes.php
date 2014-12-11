<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::model('book', 'Book');

//Route::pattern('book', '[0-9]+');

Route::get('/', function()
{
	//return View::make('hello');
	return Redirect::to('books');
});

Route::get('/test', function()
{
	return View::make('hello');
});


Route::delete('books/{id}', 'BookController@getDelete');
Route::get('books/{id}/delete', 'BookController@getDelete');
Route::controller('books', 'BookController');

//Route::get('books', function(){
//	$layout = View::make('layout');
//	$layout->title = 'Yaraku\'s Books 1.0';
//	$name = 'bino';
//	$layout->main = View::make('books')->with('content', "Hi $name, Welcome to Yaraku's Books")->with('name', $name);
//	return $layout;
//});

Route::get('book', function()
{
	$books = Book::all();

	return View::make('books')->with('books', $books);
});


Route::get('book/{id}', 'BookController@showInfo');
