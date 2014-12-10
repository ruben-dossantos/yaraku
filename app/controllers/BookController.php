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

        $orderBy = Input::get('orderBy');
        $search = Input::get('search');

        $books = Book::where('title', 'like', '%' . $search . '%')->orderBy($orderBy)->get();

        $this->layout->title = 'Yaraku\'s Bookstore';
        $this->layout->name = 'bino';
        $this->layout->books = $books;
        $this->layout->main = View::make('books')->with('books', $books);

    }

    public function postImportBooks(){

        if (Request::isMethod('post'))
        {
            $file = Input::file('file');

            try {
                $file->move('uploaded_csv/');

                if (($csv_books = fopen("uploaded_csv/" . $file->getFilename(), "r")) !== FALSE) {
                    while (($csv_book = fgetcsv($csv_books, 1000, ";")) !== FALSE) {
                        $book = new Book;
                        $book->title = $csv_book[1];
                        $book->author = $csv_book[2];
                        $book->save();
                    }
                    fclose($csv_books);
                }
                return Redirect::to('books')->with('success', 'Book(s) imported successfully!');
            } catch (BadMethodCallException $e){
                return Redirect::to('books')->with('error', 'No file selected!');
            } catch (ErrorException $e){
                return Redirect::to('books')->with('error', 'Bad file! It is supposed to be a csv with id;title;author');
            } catch (Exception $e){
                return Redirect::to('books')->with('error', 'Error unkown...' . $e);
            }

        }
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