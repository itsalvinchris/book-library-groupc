<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BorrowedBook;
use Auth;
use Carbon\Carbon;
use App\Laratables\UserBook;
use Freshbitsweb\Laratables\Laratables;

/*
    Christopher Alvin
    30 May 2019
*/

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function indexHistory()
    {
        // if(!Auth::guard('web')->check()){
        //     return redirect('/');
        // }
        $history = BorrowedBook::where('user_id', Auth::user()->id)->get();

        return view('history', compact('history'));
    }

    public function apiHistory()
    {
        return Laratables::recordsOf(UserBook::class);
    }

    public function storeBookBooking($id)
    {
        $borrow = new BorrowedBook();
        $borrow->user_id = Auth::user()->id;
        $borrow->book_id = $id;
        $borrow->date_due = Carbon::now()->addDays(2)->toDateString();
        $borrow->returned = -1;
        $borrow->save();
        return redirect ('catalog');
    }

    public function cancelBookBooking($id)
    {
        $borrow = BorrowedBook::where('id', $id)->first();
        $borrow->returned = -2;
        $borrow->save();
        return redirect('history');
    }
}
