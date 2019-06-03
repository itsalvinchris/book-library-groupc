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

        {{-- datatable --}}
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

                $('#book_table').DataTable();

                $(".btn-borrow").click( (event) => {
                    const id = event.currentTarget.id;
                    const currIndex = id.indexOf("#");
                    const index = id.substr(currIndex + 1,id.length - currIndex - 1);

                    $("#verify-nim").html($("#nim"+index).text());
                    $("#verify-name").html($("#name"+index).text());
                    $("#verify-book-title").html($("#title"+index).text());
                    $("#verify-author").html($("#author"+index).text());
                    $("#verify-date-due").html($("#date_due"+index).val());
                    
                    $("#borrow-book-verify").attr('action',"{{url('admin/borrow-book')}}/"+index);
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
            
                <input id="tab3" type="radio" name="tabs" checked>
                <label for="tab3" style="border-bottom: 2px solid #fff"><a href="{{url('/admin/borrow-book')}}">Borrow Confirmation</a></label>
            
                <input id="tab4" type="radio" name="tabs">
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
        
            <section id="content3">
                <div class="col">
                        <div class="employee">
                            <table class="table text-center custom-table text-nowrap" id="book_table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($borrows as $key => $borrow)
                                        @php
                                        $book = App\Book::where('id',$borrow->book_id)->first();    
                                        $user = App\User::where('id', $borrow->user_id)->first();
                                        @endphp
                                        <tr>
                                            <th scope="row">{{++$key}}</th>
                                            <td id="nim{{$borrow->id}}">{{$user->nim}}</td>
                                            <td id="name{{$borrow->id}}">{{$user->name}}</td>
                                            <td id="title{{$borrow->id}}">{{$book->title}}</td>
                                            <td id="author{{$borrow->id}}">{{$book->author}}</td> 
                                            <td>
                                                <input type="hidden" id="date_due{{$borrow->id}}" value="{{Carbon\Carbon::now()->addDays(7)->toDateString()}}">
                                                <button id="btn-borrow#{{$borrow->id}}" data-toggle="modal" href='#modal-borrow' class="btn btn-danger btn-borrow" style="margin: 0 10px;width: 70px;height: 25px;font-size: 12px;line-height: 12px !important;">Submit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>

                <div class="modal fade" id="modal-borrow">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title">Verify Borrow Book</h2>
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
