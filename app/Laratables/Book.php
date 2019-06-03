<?php

namespace App\Laratables;

use Illuminate\Database\Eloquent\Model;
use App\BorrowedBook;

/*
    Christopher Alvin
    30 May 2019
*/

class Book extends Model
{
    public static function laratablesModifyCollection($books)
    {
        $borrows = BorrowedBook::where('returned', '<=','0')->get();
        
        //$not_book = array();

        foreach($books as $key => $book){
            $avail = $book->quantity;
            foreach($borrows as $borrow){
                if($book->id == $borrow->book_id){
                    $avail = $avail - 1;
                    
                }
            }
            $book->title = $book->title.'+-*/'.$book->id;
            $book->author = $book->author.'+-*/'.$book->id;
            $book->publisher = $book->publisher.'+-*/'.$book->id;
            $book->quantity = $avail.'+-*/'.$book->id;
            $book->image = $book->image.'+-*/'.$book->id;
            //array_push($not_book, $book);
        }
        return $books;
    }
}
