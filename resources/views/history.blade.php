<!DOCTYPE html>
<html lang="en">
<head>
    <title>Library</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{asset('css/landing-page.css')}}">
    <link rel="shortcut icon" href="{{asset('images/logo2.png')}}">

    <meta name="keywords" content="Binus, Binus Library, Library Binus, Bina Nusantara University Library, Bina Nusantara University">
    <meta name="description" content=" Booking buku sebelum keduluan orang lain.">
    <meta name="title" content="Binus Library">

    <meta property="og:image" content="{{asset('images/logo2.png')}}">

    <meta property="og:url" content="http://library.christopheralvin.xyz/">

    <meta name="theme-color" content="#0af"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            color: #000 !important;
            background-color: rgba(0, 0, 0, 0.1) !important;
        }

        table.cards {
            background-color: transparent;
        }

        .cards tbody img {
            height: 100px;
        }

        .cards tbody tr {
            float: left;
            margin: 5px;
            border: 1px solid #aaa;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.25);
            background-color: white;
        }

        .cards tbody td {
            display: block;
            width: 300px;
            overflow: hidden;
            text-align: left;
        }

        .table {
            background-color: #fff;
        }

        .table tbody label {
            display: none;
            margin-right: 5px;
        }

        .table .glyphicon {
            font-size: 20px;
        }

        .cards .glyphicon {
            font-size: 75px;
        }

        .cards tbody label {
            display: inline;
            position: relative;
            font-weight: normal;
        }

        .cards tbody td:nth-child(1) {
            text-align: center;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jquery.dataTables.css')}}">
    <script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.js') }}"></script>


    <script type="text/javascript">
        var table = null;
        var colDefs = [
            {
                orderable: false, ajax: 'image', name: 'book_id', orderable: false, defaultContent: '', title: 'Photo',
                visible: true, className: 'text-center', width: '20px',
                createdCell: function (td, cellData, rowData, row, col) {
                    console.log(rowData)
                    var image = rowData.DT_RowData[0].image;
                    console.log(image)
                    var $ctl = $('<td class="text-center"><img id="book-img'+cellData+'"style="width: 100px; height: 100px;"src="http://'+ window.location.host + '/storage/' + image +'"></td>')
                    $(td).replaceWith($ctl);
                }
            },
            {
                ajax: "author", name: 'returned', visible: false, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) {
                    var index = data.indexOf("+-*/");
                    var id = data.substr(index+4, data.length - index -1);
                    var data = data.substr(0, index);
                    return '<label style="margin: 0;">Author:</label>' + '<label id="author'+id+'" style="margin: 0; height: 24px; overflow: hidden;">'+data+'</label>'; 
                }
            },
            {
                ajax: "author", name: 'book_id', visible: false, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) {
                    var index = data.indexOf("+-*/");
                    var id = data.substr(index+4, data.length - index -1);
                    var data = data.substr(0, index);
                    return '<label style="margin: 0;">Author:</label>' + '<label id="author'+id+'" style="margin: 0; height: 24px; overflow: hidden;">'+data+'</label>'; 
                }
            },
            {
                ajax: "date_due", name: 'date_due', visible: false, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) { 
                    var index = data.indexOf("+-*/");
                    var id = data.substr(index+4, data.length - index -1);
                    var data = data.substr(0, index);
                    return '<label style="margin: 0;">Date Due:</label>' + '<label id="publisher'+id+'" style="margin: 0; height: 24px; overflow: hidden;">'+data+'</label>';
                }
            },
            {
                ajax: "title", name: 'date_returned', visible: false, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) { 
                    var index = data.indexOf("+-*/");
                    var id = data.substr(index+4, data.length - index -1);
                    var data = data.substr(0, index);
                    return '<label style=" display: none;margin: 0;">Book Title:</label>' + '<label id="title'+id+'" style="margin: 0; height: 24px; overflow: hidden;">'+data+'</label>';
                    }
            },
            {
                ajax: "title", name: 'book_id', visible: true, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) { 
                    var title = full.DT_RowData[0].title;
                    return '<label style="margin: 0;">Book Title:</label>' + '<label id="title'+data+'" style="margin: 0; height: 24px; overflow: hidden;">'+title+'</label>';
                    }
            },
            {
                ajax: "author", name: 'book_id', visible: true, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) { 
                    var author = full.DT_RowData[0].author;
                    return '<label style="margin: 0;">Author:</label>' + '<label id="author'+data+'" style="margin: 0; height: 24px; overflow: hidden;">'+author+'</label>';
                    }
            },
            {
                ajax: "publisher", name: 'book_id', visible: true, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) { 
                    var publisher = full.DT_RowData[0].publisher;
                    return '<label style="margin: 0;">Publisher:</label>' + '<label id="publisher'+data+'" style="margin: 0; height: 24px; overflow: hidden;">'+publisher+'</label>';
                    }
            },
            {
                ajax: "date_dueORdate_returned", name: 'book_id', visible: true, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) { 
                    var returned = full[1];
                    if(returned == -2 || returned == -1 || returned == 0){
                        return '<label style="margin: 0;">Date Due:</label>' + '<label id="author'+data+'" style="margin: 0;">'+full[3]+'</label>';
                    } else{
                        return '<label style="margin: 0;">Date Returned:</label>' + '<label id="author'+data+'" style="margin: 0; height: 24px; overflow: hidden;">'+full[4]+'</label>';
                    }

                }
            },
            {
                ajax: "Available", name: 'id',visible: true, class: 'text-center',
                render: function (data, type, full, meta) { 
                    var returned = full[1];
                    if(returned == -2){
                        return '<button class="btn btn-success btn-show" style="height: 25px; font-size: 12px;line-height: 12px !important;">Canceled</button>'; 
                    } else if(returned == -1){
                        return '<button id="btn-cancel#'+data+'" data-toggle="modal" href="#modal-cancel" class="btn btn-danger btn-cancel" style="height: 25px; font-size: 12px;line-height: 12px !important;">Cancel Booking</button>'; 
                    } else if(returned == 0){
                        return '<button class="btn btn-danger btn-show" style="height: 25px; font-size: 12px;line-height: 12px !important;">Go to Library to Return the Book</button>'; 
                    } else if(returned == 1){
                        return '<button class="btn btn-success btn-show" style="height: 25px; font-size: 12px;line-height: 12px !important;">Returned</button>'; 
                    }
                    
                }
            },
        ];
        $(document).on("click", ".btn-cancel", function(event){
            const id = event.currentTarget.id;
            const currIndex = id.indexOf("#");
            const index = id.substr(currIndex + 1,id.length - currIndex - 1);
            $("#book-cancel-title").html($("#title"+index).text());
            $("#book-cancel-author").html($("#author"+index).text());
            $("#book-cancel-publisher").html($("#publisher"+index).text());
            $("#book-cancel-image").attr('src', $("#book-img"+index).attr('src'));
            $("#cancel-booking").attr('action',"{{url('catalog/book-booking/cancel')}}/"+index);
        });
        $(document).ready(function () {
            
            table = $('#register').DataTable({
                serverSide: true,
                ajax: "{{ url('api/history') }}",
                columns: colDefs,
                pagingType: 'full_numbers',
                lengthChange: false,
                pageLength: 8,
            })
                .on('select', function (e, dt, type, indexes) {
                    var rowData = table.rows(indexes).data().toArray();
                    $('.alert').html('rowData: ' + JSON.stringify(rowData));
                });
            $("#register").toggleClass('cards');
            $("#register thead").toggle();
        });
    </script>
</head>
<body onload="loadingScene()">
    
<div id="loader">
    <img src="images/loading.gif" class="img-fluid" alt="">
    <h2 class="text-center"><i>"“Reading is essential for those who seek to rise above the ordinary.”<br>Jim Rohn</i></h2>
</div>
<div class="body-content">
    <div class="landing-page" id="home-div">
        <div class="navbar" style="">
            <div class="nav-left">
                
            </div>
            <div class="nav-right">
                <div class="no-burger">
                    <a href="{{url('/')}}">Home</a>
                    <a href="{{url('/catalog')}}">Catalog</a>
                    <a href="{{url('/video')}}">Video</a>
                    @if(Auth::guard('web')->check())
                    <a href="{{url('/history')}}">History</a>
                    <label style="color: #556489;">{{Auth::user()->name}}</label>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{url('/login')}}">Login</a>
                    @endif
                    {{-- <a href="#contact-us">Contact Us</a> --}}
                </div>
                <button class="btn-burger">
                    <span class="span-1 color-super-dark"></span>
                    <span class="span-2 color-super-dark"></span>
                    <span class="span-3 color-super-dark"></span>
                </button>
            </div>
        </div>
    
        <div class="section-navbar">
            <img src="images/wave_atas.png" style="width:100%;">
            <div class="section-navbar-list"><a href="{{url('/')}}">Home</a></div>
            <div class="section-navbar-list"><a href="{{url('/catalog')}}">Catalog</a></div>
            <div class="section-navbar-list"><a href="{{url('/video')}}">Video</a></div>
            @if(Auth::guard('web')->check())
            <div class="section-navbar-list">
                <a href="{{url('/history')}}">History</a>
            </div>
            <div class="section-navbar-list">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @else
            <div class="section-navbar-list">
                <a href="{{url('/login')}}">Login</a>
            </div>
            @endif
            {{-- <div class="section-navbar-list"> <a href="#contact-us">Contact Us</a></div> --}}
            <img src="images/wave_bawah.png" style="width:100%">
        </div>
        <div class="landing-content direction-wrap mx-auto" style="width: 86%; min-height: 80vh;">
            <div class="rightreveal inner-content" style="margin-top: 65px; width: 100%;">
                <div class="row" style="width: 100%;">
                    <div class="col-sm-12 catalog">
                        <table id="register" class="table table-bordered compact dataTable no-footer" cellspacing="0"
                            style="width: 100%; border-bottom: 1px solid #dee2e6;">
                        </table>
                    </div>
                    <div class="modal fade" id="modal-cancel">
                        <div class="modal-dialog" style="margin: 1.2rem auto;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Are you sure want to cancel?</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body" style="display: flex; flex-direction: column;">
                                    <img id="book-cancel-image" style="align-self: center;max-width: 300px; max-height: 300px;"src="" alt="">
                                    <h6 for="description">Book Title</h6>
                                    <h6 id="book-cancel-title">a</h6>
                                    <h6 for="description">Author</h6>
                                    <h6 id="book-cancel-author">a</h6>
                                    <h6 for="description">Publisher</h6>
                                    <h6 id="book-cancel-publisher">a</h6>
                                    @if(Auth::guard('web')->check())
                                    <h3 for="description" class="text-danger">This will cancel your Booking</h3>
                                    @else
                                    <h4 for="description" class="text-danger">Please Login to Continue</h4>
                                    @endif
                                </div>
                                <form id="cancel-booking" action="" method="POST">
                                    @csrf
                                    <div class="modal-footer">
                                        @if(Auth::guard('web')->check())
                                        <button type="submit" class="btn btn-danger">Verify</button>
                                        @else
                                        <a href="{{url('/login')}}" class="btn btn-danger" style="text-decoration: none;">Please Login to Continue</a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
 </div> 
<script src="{{asset('js/landing-page.js')}}"></script>
</body>
</html>