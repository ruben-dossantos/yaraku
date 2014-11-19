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

Route::pattern('book', '[0-9]+');

Route::get('/', function()
{
	return View::make('hello');
});

Route::delete('books/{id}', 'BookController@getDelete');
Route::controller('books', 'BookController');

Route::get('book', function()
{
	$books = Book::all();

	return View::make('books')->with('books', $books);
});


Route::get('book/{id}', 'BookController@showInfo');
