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

    //public static function laratablesModifyCollection($borrows)
    //{
        // $books = Book::all();
        // foreach($borrows as $key => $borrow){
        //     // $avail = $book->quantity;
        //     // foreach($books as $book){
        //         // if($book->id == $borrow->book_id){
        //     $borrow->date_due = $borrow->date_due;
        //     $borrow->date_returned = $borrow->date_returned.'+-*/'.$borrow->id;
        //     $borrow->date_borrowed = $borrow->date_borrowed.'+-*/'.$borrow->id;
        //     $borrow->returned = $borrow->returned;
        //     // $borrow->title = $books[$borrow->book_id]->title.'+-*/'.$borrow->id;
        //     // $borrow->author = $books[$borrow->book_id]->author.'+-*/'.$borrow->id;
        //     // $borrow->publisher = $books[$borrow->book_id]->publisher.'+-*/'.$borrow->id;

        //             // $borrow->user_id = $book->author.'+-*/'.$borrow->id;
        //             // $borrow->created_at = $book->title.'+-*/'.$borrow->id;
        //             // $borrow->updated_at = $book->publisher.'+-*/'.$borrow->id;
        //     //     }
        //     // }
        //     // dd($borrow);

        //     //array_push($not_book, $book);
        // }
        //return $borrows;
        //array_push($kampret, $borrows);
        //array_push($kampret, $books);
        // dd($borrows->merge($books)->all());
    //     ->join('countries', 'countries.country_id', '=', 'leagues.country_id')
    // ->where('countries.country_name', $country)
    // ->get();
        //return BorrowedBook::join('books', 'books.id', '=', 'borrowed_books.book_id')->select('borrowed_books.*', 'books.title', 'books.author', 'books.publisher')->get();
    //}

    public function laratablesRowData()
    {
        $book = Book::where('id', $this->book_id)->get();
        return $book;
    }
}
