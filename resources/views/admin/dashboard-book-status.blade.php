<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}" >

        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jquery.dataTables.css')}}">
        <script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.js') }}"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                if($('#tab1').is(':checked')) { 
                    $("#content1").css({ display: "block" });
                }

                if($('#tab2').is(':checked')) { 
                    $("#content2").css({ display: "block" });
                }

                if($('#tab3').is(':checked')) { 
                    $("#content3").css({ display: "block" });
                }

                if($('#tab4').is(':checked')) { 
                    $("#content4").css({ display: "block" });
                }

                if($('#tab5').is(':checked')) { 
                    $("#content5").css({ display: "block" });
                }

                $('#book_table').DataTable();

                $(".btn-return").click( (event) => {
                    const id = event.currentTarget.id;
                    const currIndex = id.indexOf("#");
                    const index = id.substr(currIndex + 1,id.length - currIndex - 1);

                    $("#verify-nim").html($("#nim"+index).text());
                    $("#verify-name").html($("#name"+index).text());
                    $("#verify-book-title").html($("#title"+index).text());
                    $("#verify-author").html($("#author"+index).text());
                    $("#verify-date-due").html($("#date_due"+index).text());
                    if($("#penalty"+index).val() != null){
                        $("#verify-penalty").html("Rp. "+$("#penalty"+index).val() * 5000);
                    } else{
                        $("#verify-penalty").html("Rp. 0");
                    }
                    
                    $("#borrow-book-verify").attr('action',"{{url('admin/return-book')}}/"+index);
                });
            });
        </script>
        <title>Library | Admin</title>
    </head>
    <body>
        <main>
            <div class="navbar navbar-fixed-top">
                <input id="tab1" type="radio" name="tabs">
                <label for="tab1"><a href="{{url('/admin')}}">List Book</a></label>
            
                <input id="tab2" type="radio" name="tabs">
                <label for="tab2"><a href="{{url('/admin/add-book')}}">Add Book</a></label>
            
                <input id="tab3" type="radio" name="tabs">
                <label for="tab3"><a href="{{url('/admin/borrow-book')}}">Borrow Confirmation</a></label>
            
                <input id="tab4" type="radio" name="tabs" checked>
                <label for="tab4"><a href="{{url('/admin/book-status')}}">Book Status</a></label>

                <input id="tab5" type="radio" name="tabs">
                <label for="tab5"><a href="{{url('/admin/video')}}">Video</a></label>

                <a class="btn btn-primary logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        
            <section id="content4">
                    <div class="employee">
                        {{-- <p>List Book</p> --}}
                        <table class="table text-center custom-table text-nowrap" id="book_table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($borrow_book as $key => $borrow)
                                    @php
                                    $book = App\Book::where('id',$borrow->book_id)->first();    
                                    $user = App\User::where('id', $borrow->user_id)->first();
                                    @endphp
                                    @if(Carbon\Carbon::now()->diffInDays($borrow->date_due, false) < 0 && $borrow->returned ==0)
                                    <tr style="background-color: red">
                                            
                                    @else
                                    <tr>
                                    @endif
                                        <th scope="row">{{++$key}}</th>
                                        <td id="nim{{$borrow->id}}">{{$user->nim}}</td>
                                        <td id="name{{$borrow->id}}">{{$user->name}}</td>
                                        <td id="title{{$borrow->id}}">{{$book->title}}</td>
                                        <td id="author{{$borrow->id}}">{{$book->author}}</td> 
                                        <td id="date_due{{$borrow->id}}">{{$borrow->date_due}}</td>
                                        <td>
                                            @if($borrow->returned == 1)
                                                <button class="btn btn-success" style="margin: 0 10px;width: 80px;height: 25px;font-size: 12px;line-height: 12px !important;">Returned</button>
                                            @elseif($borrow->returned == -2)
                                                <button class="btn btn-success" style="margin: 0 10px;width: 80px;height: 25px;font-size: 12px;line-height: 12px !important;">Canceled</button>
                                            @else
                                                <button id="btn-return#{{$borrow->id}}" data-toggle="modal" href='#modal-return' class="btn btn-danger btn-return" style="margin: 0 10px;width: 80px;height: 25px;font-size: 12px;line-height: 12px !important;">Return</button>
                                            @endif
                                            @if(Carbon\Carbon::now()->diffInDays($borrow->date_due, false) < 0 && $borrow->returned ==0)
                                            <input type="hidden" id="penalty{{$borrow->id}}" value="{{Carbon\Carbon::now()->diffInDays($borrow->date_due)}}">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modal-return">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Verify Return Book</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <h4 for="description">NIM</h4>
                                    <h5 id="verify-nim">a</h5>
                                    <h4 for="description">Name</h4>
                                    <h5 id="verify-name">a</h5>
                                    <h4 for="description">Book Title</h4>
                                    <h5 id="verify-book-title">a</h5>
                                    <h4 for="description">Author</h4>
                                    <h5 id="verify-author">a</h5>
                                    <h4 for="description">Date Due</h4>
                                    <h5 id="verify-date-due">a</h5>
                                    <h4 for="description">Penalty</h4>
                                    <h5 id="verify-penalty">Rp. 0</h5>
                                </div>
                                <form id="borrow-book-verify" action="" method="POST">
                                    @csrf
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Verify</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </section>
            
            
        </main>
    
    </body>
</html>
