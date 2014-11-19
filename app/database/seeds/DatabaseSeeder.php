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

		$this->call('BookTableSeeder');

		$this->command->info('Book table seeded!');
		// $this->call('UserTableSeeder');
	}

}

class BookTableSeeder extends Seeder {

	public function run()
	{
		$this->command->info('truncate!');
		DB::table('books')->delete();
		Book::truncate();
		Book::create(['title' => 'Green Mile', "author" => "Stephen King"]);

	}
}
