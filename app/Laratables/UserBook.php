<?php

namespace App\Laratables;

use Illuminate\Database\Eloquent\Model;
use App\BorrowedBook;
use App\Book;
use Auth;

/*
    Christopher Alvin
    30 May 2019
*/

class UserBook extends Model
{
    protected $table = 'borrowed_books';

    public static function laratablesQueryConditions($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function laratablesRowData()
    {
        //dd($this->book_id);
        $book = Book::where('id', $this->book_id)->get();
        return $book;
    }
}
