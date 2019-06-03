<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Laratables\Book;
use App\Laratables\Video;
use Freshbitsweb\Laratables\Laratables;

// use App\Laratables\UserBook;

/*
    Christopher Alvin
    30 May 2019
*/

class HomePageController extends Controller
{
    public function index()
    {
        return view('landing-page');
    }

    public function indexCatalog()
    {

        return view('catalog');
    }
    public function apiCatalog(){
        return Laratables::recordsOf(Book::class);
    }

    public function indexVideo()
    {

        return view('video');
    }
    public function apiVideo(){
        // return Laratables::recordsOf(Book::class);
        // return Laratables::recordsOf(UserBook::class);
        return Laratables::recordsOf(Video::class);
    }


}
