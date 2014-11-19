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

        $books = $this->$book;

//        $d = dir(".");
//        echo "Handle: " . $d->handle . "\n";
//        echo "Path: " . $d->path . "\n";
//        while (false !== ($entry = $d->read())) {
//            echo $entry."\n";
//        }
//        $d->close();

        if (($books = fopen("../private/books.csv", "r")) !== FALSE) {
            while (($bookArray = fgetcsv($books, 1000, ";")) !== FALSE) {
                echo "id: " . $bookArray[0] . "<br>";
                echo "title: " . $bookArray[1] . "<br>";
                echo "author: " . $bookArray[2] . "<br>";
                echo "<br>";
                $book = new Book;
                $book->title = $bookArray[1];
                $book->author = $bookArray[2];
//                $book->save();
            }
            fclose($books);
        }


//        $books = csvToArray('../private/books.csv');
//        $books = array_map('str_getcsv', file('private/books.csv'));
//        foreach($books as $key => $book){
//            echo $book[0];
//            $book = new Book;
//            $book->title = $book[1];
//            $book->author = $book[2];
//            $book->save();
//        }
//        echo $books;
        return View::make('books');
    }

    public function getImportBooks()
    {
        $book = new Book;
//        $book->id = 2;
        $book->title= "Da Vinci Code";
        $book->author= "Dan Brown";
        $book->save();
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