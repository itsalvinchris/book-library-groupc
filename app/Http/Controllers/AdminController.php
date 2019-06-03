<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Book;
use App\BorrowedBook;
use App\Video;
use Carbon\Carbon;
use Storage;

/*
    Christopher Alvin
    30 May 2019
*/

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        $borrows = BorrowedBook::where('returned', '<=','0')->where('returned', '!=', '-2')->get();
        
        $not_book = array();

        foreach($books as $key => $book){
            $avail = $book->quantity;
            foreach($borrows as $borrow){
                if($book->id == $borrow->book_id){
                    $avail = $avail - 1;
                }
            }
            $book->quantity = $avail.'/'.$book->quantity;
            array_push($not_book, $book);
        }

        return view('admin.dashboard',compact('not_book'));
    }

    public function indexAddBook()
    {
        //$books = Book::all();
        return view('admin.dashboard-add-book');
    }

    public function indexBorrowBook()
    {
        $borrows = BorrowedBook::where('returned', '=','-1')->get();
        return view('admin.dashboard-borrow-book',compact('borrows'));
    }

    public function indexBookStatus()
    {
        $borrow_book = BorrowedBook::orWhere(function($query){
            $query->where('returned', '>=', 0)
                  ->orWhere('returned', '=', -2);
        })->get();
        return view('admin.dashboard-book-status',compact('borrow_book'));
    }

    public function indexListVideo()
    {
        $videos = Video::all();
        return view('admin.dashboard-list-video',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeAddBook(Request $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->publisher = $request->publisher;
        $book->quantity = $request->quantity;
        $file_name = Carbon::now()->timestamp.'.'.$request->book_image->extension();
        Storage::disk('local')->put('public/book_images/'.$file_name, file_get_contents($request->book_image));
        $book->image = 'book_images/'.$file_name;
        $book->save();
        return redirect('admin/add-book');
    }

    public function storeBorrowBook(Request $request, $id)
    {
        $borrow = BorrowedBook::where('id',$id)->first();
        $borrow->date_borrowed = Carbon::now()->toDateString();
        $borrow->date_due = Carbon::now()->addDays(7)->toDateString();
        $borrow->returned = 0;
        $borrow->save();
        return redirect('admin/borrow-book');
    }

    public function storeReturnBook(Request $request, $id)
    {
        $borrow = BorrowedBook::where('id',$id)->first();
        $borrow->returned = 1;
        $borrow->save();
        return redirect('admin/book-status');
    }

    public function storeVideo(Request $request)
    {
        $name = $request->video_title.Carbon::now()->timestamp.'.'.$request->video_file->extension();
        $thumb = $request->video_title.Carbon::now()->timestamp.'.'.$request->thumb_file->extension();
        $video = new Video();
        
        $video->title = $request->video_title;
        $video->description = $request->video_desc;
        $video->video = 'video/'.$name;
        $ftp = Storage::disk('local')->put('public/'.$video->video, file_get_contents($request->video_file));
        $video->thumbnail = 'video_thumbnail/'.$thumb;
        $ftp_thumb = Storage::disk('local')->put('public/'.$video->thumbnail, file_get_contents($request->thumb_file));
        $video->save();
        return redirect('admin/video');
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    public function updateBook(Request $request, Book $book)
    {
        if($request->hasFile('book_file')){
            $file_name = Carbon::now()->timestamp.'.'.$request->book_file->extension();
            if($book->image != 'book_images/book.jpeg'){
                Storage::disk('local')->delete('public/'.$book->image);
            }
            $book->title = $request->title;
            $book->author = $request->author;
            $book->isbn = $request->isbn;
            $book->publisher = $request->publisher;
            $book->quantity = $request->quantity;
            $book->image = 'book_images/'.$file_name;
            Storage::disk('local')->put('public/'.$book->image, file_get_contents($request->book_file));
        } else{
            $book->title = $request->title;
            $book->author = $request->author;
            $book->isbn = $request->isbn;
            $book->publisher = $request->publisher;
            $book->quantity = $request->quantity;
        }
        $book->update();
        return redirect('admin/');
    }

    public function updateVideo(Request $request, Video $video){
        if($request->hasFile('video_file')){
            $name = $request->video_title.Carbon::now()->timestamp.'.'.$request->video_file->extension();
            Storage::disk('local')->delete('public/'.$video->video);
            $video->title = $request->video_title;
            $video->description = $request->video_desc;
            $video->video = 'video/'.$name;
            
            Storage::disk('local')->put('public/'.$video->video, file_get_contents($request->video_file));
            if($request->hasFile('thumb_file')){
                $thumb = $request->video_title.Carbon::now()->timestamp.'.'.$request->thumb_file->extension();
                Storage::disk('local')->delete('public/'.$video->thumbnail);
                $video->thumbnail = 'video_thumbnail/'.$thumb;
                Storage::disk('local')->put('public/'.$video->thumbnail, file_get_contents($request->thumb_file));
            }
        } else{
            if($request->hasFile('thumb_file')){
                $thumb = $request->video_title.Carbon::now()->timestamp.'.'.$request->thumb_file->extension();
                Storage::disk('local')->delete('public/'.$video->thumbnail);
                $video->thumbnail = 'video_thumbnail/'.$thumb;
                Storage::disk('local')->put('public/'.$video->thumbnail, file_get_contents($request->thumb_file));
            }
            $video->title = $request->video_title;
            $video->description = $request->video_desc;
        }
        $video->update();
        return redirect('admin/video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function destroyBook(Book $book){
        if($book->image != 'book_images/book.jpeg'){
            Storage::disk('local')->delete('public/'.$book->image);
        }
        $book->delete();
        return redirect('admin/');
    }

    public function destroyVideo(Video $video){
        if($video->video != 'video/Mars Binusian - YouTube.mp4' && $video->video != 'video/Himne Perguruan Tinggi Binus - YouTube.mp4'){
            Storage::disk('local')->delete('public/'.$video->video);
        }
        if($video->thumbnail != 'video_thumbnail/Mars Binusian - YouTube.png' && $video->thumbnail != 'video_thumbnail/Himne Perguruan Tinggi Binus - YouTube.png'){
            Storage::disk('local')->delete('public/'.$video->thumbnail);
        }
        $video->delete();
        return redirect('admin/video');
    }

    
}
