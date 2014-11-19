<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
//		Eloquent::unguard();

		$book = new Book;
		$book->id = 2;
		$book->title= "Da Vinci Code";
		$book->author= "Dan Brown";
		$book->save();

		// $this->call('UserTableSeeder');
	}

}
