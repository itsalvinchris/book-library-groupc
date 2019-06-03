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

        .button-login-bro > button{
            border: solid 2px #008fe0;
            background: none;
            width: 8em;
            font-size: 1.8em;
            height: 2.2em;
            border-radius: 8em;
            color: #008fe0;
            font-weight: bold;
            transition: .5s;
            cursor: pointer;
            margin: .5em 0;
        }
        .button-login-bro:hover > button{
            background: #008fe0;
            border: none;
            color: white;	
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jquery.dataTables.css')}}">
    <script type="text/javascript" src="{{ asset('js/admin/jquery.dataTables.js') }}"></script>


    <script type="text/javascript">
        var table = null;
        var colDefs = [
            {
                orderable: false, ajax: 'thumbnail', name: 'thumbnail', orderable: false, defaultContent: '', title: 'Photo',
                visible: true, className: 'text-center', width: '20px',
                createdCell: function (td, cellData, rowData, row, col) {
                    var $ctl = $('<td class="text-center"><img id="book-img"style="width: 200px; height: 200px;"src="http://'+ window.location.host + '/storage/' + cellData +'"></td>')
                    $(td).replaceWith($ctl);
                }
            },
            {
                ajax: "title", name: 'title', visible: true, class: 'd-flex justify-content-center align-items-center',
                render: function (data, type, full, meta) {
                    return '<label id="author" style="margin: 0; min-height: 48px; overflow: hidden;">'+data+'</label>'; 
                }
            },
            {
                ajax: "description", name: 'description', visible: false, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) {
                    return '<label style="margin: 0;">Author:</label>' + '<label id="author" style="margin: 0;">'+data+'</label>'; 
                }
            },
            {
                ajax: "video", name: 'video', visible: false, class: 'd-flex justify-content-between align-items-center',
                render: function (data, type, full, meta) {
                    return '<label style="margin: 0;">Author:</label>' + '<label id="author" style="margin: 0;">'+data+'</label>'; 
                }
            },
        ];

        $(document).on("click-row.bs.table", "#register", function(event, row, $element){
            console.log($element);
            console.log(row);
            console.log(event);

        });
        $(document).ready(function () {
            
            table = $('#register').DataTable({
                serverSide: true,
                ajax: "{{ url('api/video') }}",
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
            $('.dataTable').on('click', 'tbody tr', function() {
                console.log("{{Auth::guard('web')->check()}}");
                if("{{Auth::guard('web')->check()}}"){
                    $('#modal-title').text(table.row(this).data()[1]);
                    console.log(table.row(this).data()[1]);
                    console.log(table.row(this).data()[3]);
                    $('#video-id source').attr('src',"{{url('/storage/')}}"+"/"+table.row(this).data()[3]);
                    $('#video-id')[0].load();
                }
                $("#modal-video").modal('show');
            });
            $('.videoModal').on('hidden.bs.modal', function(e) {
                if("{{Auth::guard('web')->check()}}"){
                    console.log('yes')    
                    $('#video-id').get(0).pause();
                }
            });
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
            <label style="color: #556489; font-size: 1.5em;">{{Auth::user()->name}}</label>
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
            <img src="images/wave_bawah.png" style="width:100%">
        </div>
        <div class="landing-content direction-wrap mx-auto" style="width: 86%; max-height: 80vh;">
            <div class="rightreveal inner-content" style="margin-top: 65px; width: 100%;">
                <div class="row" style="width: 100%;">
                    <div class="col-sm-12 catalog">
                        <table id="register" class="table table-bordered compact dataTable no-footer" cellspacing="0"
                            style="width: 100%; border-bottom: 1px solid #dee2e6;">
                        </table>
                    </div>
                    <div class="modal fade videoModal" id="modal-video">
                        <div class="modal-dialog" style="max-width: 1140px; margin-top: 1.4rem;margin-bottom: 1.4rem;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 id="modal-title" class="modal-title">Please Login to Continue</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-content" style="max-height: 85vh; min-height: 85vh;"> 
                                    @if(Auth::guard('web')->check())   
                                    <video id="video-id" controls>
                                        <source src="{{asset('storage/video/Mars Binusian - YouTube.mp4')}}" type="video/mp4">
                                    </video>
                                    @else
                                        <h1 class="text-center mt-auto text-danger">Please Login to Continue</h1>
                                        <div class="text-center mb-auto">
                                            <a style="color: #007bff; text-decoration: none; background-color: transparent;" class="button-login-bro" href="{{url('login')}}">
                                                <button type="submit">LOGIN</button>
                                            </a>
                                        </div>
                                    @endif
                                </div>
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