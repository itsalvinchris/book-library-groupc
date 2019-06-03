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


        <!-- font -->
        {{-- <link
        href="https://fonts.googleapis.com/css?family=Heebo:700|Rajdhani|Roboto+Condensed"
        rel="stylesheet"
        /> --}}
        <!-- css -->

        <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}" >
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/AdminLTE.min.css') }}" > --}}

        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/about-us.css') }}" > --}}
        <!-- font awesome -->
        {{-- <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        /> --}}

        <!--Bootstrap local-->
        {{-- <script src="/assets/bootstrap/css/bootstrap.min.css"></script> --}}
        {{-- <script src="/assets/jquery/jquery-3.3.1.min.js"></script> --}}

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
                $("#book_table_wrapper").addClass('table-responsive text-nowrap');


                $('#book_table').DataTable({columnDefs: [
                    { targets: 'no-sort', orderable: false }
                ]});

                $(".btn-show").click( (event) => {
                    const id = event.currentTarget.id;
                    const currIndex = id.indexOf("#");
                    const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                    $('#image-show').attr('src', "{{url('storage/')}}/"+$("#filename"+index).val());
                });

                $('.btn-delete').click(function(){
                    const id = this.id;
                    const currIndex = id.indexOf("#");
                    const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                    $('#delete-video-title').html($('#title'+index).html());
                    $('#modal-video-delete').attr('action',"{{url('/admin/add-book/')}}/"+index);
                });

                $(".btn-edit").click( (event) => {
                    const id = event.currentTarget.id;
                    const currIndex = id.indexOf("#");
                    const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                    // var path_file_name = $("#nama-file"+index).text();
                    // path_file_name = path_file_name.split(';');
                    // var file_name_with_ext = path_file_name[1];
                    // file_name_with_ext = file_name_with_ext.split('.');
                    // var file_name = file_name_with_ext[0];
                    // $("#edit-name").val(file_name);
                    $("#update-title").val($('#title'+index).html());
                    $("#update-author").val($('#author'+index).html());
                    $("#update-isbn").val($('#isbn'+index).html());
                    $("#update-author").val($('#author'+index).html());
                    $("#update-publisher").val($('#publisher'+index).html());
                    $("#update-quantity").val($('#quantity'+index).html());
                    $("#modal-video-edit").attr('action',"{{url('/admin/add-book')}}/"+index);
                });
        
                // $(".btn-show").click( (event) => {
                //     const id = event.currentTarget.id;
                //     const currIndex = id.indexOf("#");
                //     const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                // });
                $("#book-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });

                $('#modal-current').on('hidden.bs.modal', function (e) {
                    $("#file-name").removeClass("selected").html("Book File (Leave this If dont want to change)");
                })
        
            });
        </script>
        <title>Library | Admin</title>
    </head>
    <body>
        <main>
            <div class="navbar navbar-fixed-top">
                <input id="tab1" type="radio" name="tabs" checked>
                <label for="tab1"><a href="{{url('/admin')}}">List Book</a></label>
            
                <input id="tab2" type="radio" name="tabs">
                <label for="tab2"><a href="{{url('/admin/add-book')}}">Add Book</a></label>
            
                <input id="tab3" type="radio" name="tabs">
                <label for="tab3"><a href="{{url('/admin/borrow-book')}}">Borrow Confirmation</a></label>
            
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
        
            <section id="content1">
                <div class="employee">
                    {{-- <p>List Book</p> --}}
                    <table class="table text-center custom-table text-nowrap" id="book_table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Publisher</th>
                                <th scope="col">Available</th>
                                <th scope="col">Quantity</th>
                                <th scope="col" class="no-sort"></th>
                                <th scope="col" class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($not_book as $key => $book)
                                @php
                                $qty = explode('/', $book->quantity);    
                                @endphp
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td id="title{{$book->id}}">{{$book->title}}</td>
                                    <td id="author{{$book->id}}">{{$book->author}}</td>
                                    <td id="isbn{{$book->id}}">{{$book->isbn}}</td>
                                    <td id="publisher{{$book->id}}">{{$book->publisher}}</td>
                                    <td id="available{{$book->id}}">{{$qty[0]}}</td>
                                    <td id="quantity{{$book->id}}">{{$qty[1]}}</td>  
                                    <td>
                                        <input type="hidden" id="filename{{$book->id}}" value="{{$book->image}}">
                                        <button id="btn-show#{{$book->id}}" data-toggle="modal" href='#modal-id' class="btn btn-danger btn-show" style="margin: 0 10px;width: 100px;height: 25px;font-size: 12px;line-height: 12px !important;">Show Image</button>
                                            {{-- <button id="btn-borrow#{{$book->id}}" data-toggle="modal" href='#modal-borrow' class="btn btn-danger btn-borrow" style="margin: 0 10px;width: 70px;height: 25px;font-size: 12px;line-height: 12px !important;">Add</button> --}}
                                        <button id="btn-update#{{$book->id}}" data-toggle="modal" href='#modal-current' class="btn btn-danger btn-edit" style="margin: 0 10px;width: 70px;height: 25px;font-size: 12px;line-height: 12px !important;">Update</button>
                                        {{-- <button id="btn-borrow#{{$book->id}}" data-toggle="modal" href='#modal-borrow' class="btn btn-danger btn-borrow" style="margin: 0 10px;width: 70px;height: 25px;font-size: 12px;line-height: 12px !important;">Delete</button> --}}
                                        {{-- <input type="hidden" id="filename{{$product->id}}" value="{{$image}}"> --}}
                                        {{-- <button id="btn-show#{{$product->id}}" data-toggle="modal" href='#modal-show' class="btn btn-primary btn-show" style="width: 85px;">Show Image</button> --}}
                                        {{-- <button id="btn-edit#{{$product->id}}" data-toggle="modal" href='#modal-current' class="btn btn-primary btn-edit">@lang('content.Edit')</button> --}}
                                        {{-- <button id="btn-delete#{{$product->id}}" data-toggle="modal" href='#modal-delete' class="btn btn-danger btn-delete">@lang('content.Hapus')</button> --}}
                                    </td>
                                    <td>
                                        <button id="btn-delete#{{$book->id}}" data-toggle="modal" href='#modal-delete' class="btn btn-danger btn-delete" style="margin: 0 10px;width: 70px;height: 25px;font-size: 12px;line-height: 12px !important;">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



                    <div class="modal fade" id="modal-id">
                        <div class="modal-dialog" style="min-width: 1140px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Image</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                {{-- <form id="product-delete" action="" method="POST"> --}}
                                    {{-- @csrf --}}
                                    <img id="image-show" class="img-responsive" src="{{url('storage/product_images/1557770671.png')}}" alt="" srcset="" stlye="max-width: 400px; max-height: 500px;">
                                    <div class="modal-footer">
                                        <button id="modal-close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-current">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 id="edit-modal-title" class="modal-title">Update Book</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form id="modal-video-edit" action="{{url('/admin')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <div class="modal-body" style="padding: 5px 20px 20px;">
                                        <div class="body-content">
                                            <label>Title</label>
                                            <input id="update-title" required type="text" placeholder="Title" class="form-control" name="title">
                                            <label>Author</label>
                                            <input id="update-author" required type="text" placeholder="Author" class="form-control" name="author">
                                            <label>ISBN</label>
                                            <input id="update-isbn" required type="text" placeholder="ISBN" class="form-control" name="isbn">
                                            <label>Publisher</label>
                                            <input id="update-publisher" required type="text" placeholder="Publisher" class="form-control" name="publisher">
                                            <label>Quantity</label>
                                            <input id="update-quantity" style="margin-bottom: 0;" required type="number" placeholder="Quantity" class="form-control" name="quantity">
                                        </div>
                                        <div class="custom-file ">
                                            <input type="file" class="custom-file-input" name="book_file" id="book-file-input">
                                            <label class="custom-file-label text-left" for="customFile" id="file-name">Book File(Leave this If dont want to change)</label>
                                        </div>
                                        {{-- <label for="library_file">File (Don't Browser If dont want to change the picture)</label>
                                        <input style="margin-bottom: 20px;" id="library_file" type="file" name="book_file"> --}}
                                    </div>
                                    
                                    <div class="modal-footer" style="margin-top: 10px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                    <div class="modal fade" id="modal-delete">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Are you sure want to delete?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form id="modal-video-delete" action="{{url('admin')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <h4 for="description">Book Title</h4>
                                        <h5 id="delete-video-title">a</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

    
    
    </body>
</html>
