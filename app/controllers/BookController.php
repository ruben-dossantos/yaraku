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

//        $d = dir(".");
//        echo "Handle: " . $d->handle . "\n";
//        echo "Path: " . $d->path . "\n";
//        while (false !== ($entry = $d->read())) {
//            echo $entry."\n";
//        }
//        $d->close();

    public function getIndex()
    {

        $orderBy = Input::get('orderBy');
        $search = Input::get('search');

//        $books = DB::table('books')->where('title', 'like', '%' . $search . '%')->orderBy($orderBy)->get();
//        $books = Book::get()->where('title', 'like', '%' . $search . '%')->orderBy($orderBy)->get();

//        foreach ($books as $book)
//        {
//            echo "El identificador: ". $book->id ."; El titulo: ". $book->title . '; El autor: ' . $book->author;
//            echo "<br>";
//        }

//        return View::make('books', ['name'=>'bino']);
        $books = Book::where('title', 'like', '%' . $search . '%')->orderBy($orderBy)->get();

        $this->layout->title = 'Yaraku\'s Bookstore';
        $this->layout->name = 'bino';
        $this->layout->books = $books;
        $this->layout->main = View::make('books')->with('books', $books);

    }

    public function postImportBooks(){

        if (Request::isMethod('post'))
        {
            $file = Input::file('file')->getFilename();
            if(Input::file('file')->isValid()){
                echo "hasFile";
            }
            echo $file;

            Input::file('file')->move('uploaded_csv/');

            if (($csv_books = fopen("uploaded_csv/" . $file, "r")) !== FALSE) {
                while (($csv_book = fgetcsv($csv_books, 1000, ";")) !== FALSE) {
                    $book = new Book;
                    $book->title = $csv_book[1];
                    $book->author = $csv_book[2];
                    $book->save();
                }
                fclose($csv_books);
            }
            return Redirect::to('books')->with('success', 'Book(s) imported successfully!');

        }

        $this->layout->title = 'Yaraku\'s Bookstore';
        $this->layout->name = 'bino';
        $this->layout->main = View::make('books');
    }

    public function getImportBooks()
    {
        if (($csv_books = fopen("../private/books.csv", "r")) !== FALSE) {
            while (($csv_book = fgetcsv($csv_books, 1000, ";")) !== FALSE) {
                $book = new Book;
                $book->title = $csv_book[1];
                $book->author = $csv_book[2];
                $book->save();
            }
            fclose($csv_books);
        }
        return Redirect::to('books')->with('success', 'Book(s) imported successfully!');
    }

    public function getDelete($id)
    {
        $book = Book::find($id);
        if(isset($book)){
            $book->delete();
            return Redirect::to('books')->with('success', 'Book deleted successfully!');
        } else {
            return 'book not found!';
        }
    }
}