<?php
/**
 * Created by IntelliJ IDEA.
 * User: ruben
 * Date: 19-11-2014
 * Time: 14:53
 */
class BookController extends BaseController {

    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function getIndex()
    {
        $books = DB::table('books')->get();

        foreach ($books as $book)
        {
            echo "El titulo: ". $book->title;
            echo "<br>";
        }

//        $d = dir(".");
//        echo "Handle: " . $d->handle . "\n";
//        echo "Path: " . $d->path . "\n";
//        while (false !== ($entry = $d->read())) {
//            echo $entry."\n";
//        }
//        $d->close();


        return View::make('books');
    }

    public function getImportBooks()
    {
//        $book = new Book;
//        $book->id = 2;
//        $book->title= "The Mist";
//        $book->author= "Stephen King";
//        $book->save();

        if (($csv_books = fopen("../private/books.csv", "r")) !== FALSE) {
            while (($csv_book = fgetcsv($csv_books, 1000, ";")) !== FALSE) {
                echo "id: " . $csv_book[0] . "<br>";
                echo "title: " . $csv_book[1] . "<br>";
                echo "author: " . $csv_book[2] . "<br>";
                echo "<br>";

                $book = new Book;
                $book->title = $csv_book[1];
                $book->author = $csv_book[2];
                $book->save();
            }
            fclose($csv_books);
        }

//        $csv_books = array_map('str_getcsv', file('../private/books.csv'));
//        foreach($csv_books as $key => $csv_book){
//            $book = new Book;
//            $book->title = $csv_book[1];
//            $book->author = $csv_book[2];
//            $book->save();
//        }

        return 'importing books...';
    }

    public function getDelete($book)
    {
        return 'deleteBooks';
    }


    public function showInfo($id)
    {
//        $books = DB::table('books')->get();
//
//        foreach($books as $book)
//        {
//            var_dump($book->author);
//            echo $book;
//        }

        $data['result'] = DB::select('select title from books');


//        echo $books;
//        $book = Book::find($id);
//
//        echo $book . '<br>';

        return $id;
    }
}