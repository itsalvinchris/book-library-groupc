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

                $('#book_table').DataTable();
        
                // $(".btn-show").click( (event) => {
                //     const id = event.currentTarget.id;
                //     const currIndex = id.indexOf("#");
                //     const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                // });

                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#book-img').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#book-image").change(function(){
                    readURL(this);
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
            
                <input id="tab2" type="radio" name="tabs" checked>
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
        
            <section id="content2">
                {{-- <div id="add-book"> --}}
                    <form method="POST" action="{{url('admin/add-book/')}}" enctype="multipart/form-data">
                        @csrf
                                         
                                <h4 class="panel-title">Add Book</h4>
                                <div class="row">
                                    <div class="col-6" style="margin-top: 9.5px;">
                                        <h6>Title</h6>
                                        <input required type="text" placeholder="Title" class="form-control" name="title">
                                        <h6>Author</h6>
                                        <input required type="text" placeholder="Author" class="form-control" name="author">
                                        <h6>ISBN</h6>
                                        <input required type="text" placeholder="ISBN" class="form-control" name="isbn">
                                        <h6>Publisher</h6>
                                        <input required type="text" placeholder="Publisher" class="form-control" name="publisher">
                                        <h6>Quantity</h6>
                                        <input required type="number" placeholder="Quantity" class="form-control" name="quantity">
                                    </div>
    
                                    <div class="col-6 text-center">
                                        <div>
                                                <img src="{{url('/images/img-placeholder.png')}}" id="book-img" class="book-image img-responsive"style="width: 300px; height: 300px;"alt="...">
                                        </div>
                                        <div class="custom-file ">
                                            <input type="file" class="custom-file-input" name="book_image" id="book-image">
                                            <label class="custom-file-label text-left" for="customFile" id="file-name">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                                
                                                                        
                                <div class="col-12 text-center" style="margin-top: 5px; /*border-top: 1px solid #abc*/">
                                    <button type="submit" class="btn btn-danger center" style="margin-top: 5px;">Submit</button>
                                </div>
                    </form>
                {{-- </div> --}}
                    
            </section>
        
        
            
            
        </main>
    
    </body>
</html>
