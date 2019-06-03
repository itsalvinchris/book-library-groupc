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

                $('#book_table').DataTable();
        
                // $(".btn-show").click( (event) => {
                //     const id = event.currentTarget.id;
                //     const currIndex = id.indexOf("#");
                //     const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                // });
        
            });
        </script>
        <title>Library | Admin</title>
    </head>
    <body>
        <main>

            <input id="tab1" type="radio" name="tabs" checked>
            <label for="tab1">List Book</label>
        
            <input id="tab2" type="radio" name="tabs">
            <label for="tab2">Add Book</label>
        
            <input id="tab3" type="radio" name="tabs">
            <label for="tab3">Return Book</label>
        
            <input id="tab4" type="radio" name="tabs">
            <label for="tab4">List Video</label>

            <a class="btn btn-primary logout" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        
            <section id="content1">
                <div class="employee table-responsive">
                    {{-- <p>List Book</p> --}}
                    <table class="table text-center" id="book_table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Publisher</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $key => $book)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td id="title{{$book->id}}">{{$book->title}}</td>
                                    <td id="author{{$book->id}}">{{$book->author}}</td>
                                    <td id="isbn{{$book->id}}">{{$book->isbn}}</td>
                                    <td id="publisher{{$book->id}}">{{$book->publisher}}</td>
                                    <td id="quantity{{$book->id}}">{{$book->quantity}}</td>  
                                    <td>
                                        {{-- <input type="hidden" id="filename{{$product->id}}" value="{{$image}}"> --}}
                                        {{-- <button id="btn-show#{{$product->id}}" data-toggle="modal" href='#modal-show' class="btn btn-primary btn-show" style="width: 85px;">Show Image</button> --}}
                                        {{-- <button id="btn-edit#{{$product->id}}" data-toggle="modal" href='#modal-current' class="btn btn-primary btn-edit">@lang('content.Edit')</button> --}}
                                        {{-- <button id="btn-delete#{{$product->id}}" data-toggle="modal" href='#modal-delete' class="btn btn-danger btn-delete">@lang('content.Hapus')</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        
            <section id="content2">
                {{-- <div id="add-book"> --}}
                    <form method="POST" action="{{url('book/')}}">
                        @csrf
                                         
                                <h3 class="panel-title">Data Pemesan</h3>
                                <div class="col-6">
                                    <h4>Nama</h4>
                                    <input required type="text" placeholder="Nama" class="form-control" name="name">
                                    <h4>Alamat</h4>
                                    <input required type="text" placeholder="Email" class="form-control" name="address">
                                    <h4>No. Telepon</h4>
                                    <input required type="text" placeholder="No. Telepon" class="form-control" name="phone">
                                    <input type="hidden" name="date" id="dateInput">
                                </div>
                                                                        
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Pilih</button>
                                </div>
                    </form>
                {{-- </div> --}}
                    
            </section>
        
            <section id="content3">
            <p>
                Jerky jowl pork chop tongue, kielbasa shank venison. Capicola shank pig ribeye leberkas filet mignon brisket beef kevin tenderloin porchetta. Capicola fatback venison shank kielbasa, drumstick ribeye landjaeger beef kevin tail meatball pastrami prosciutto pancetta. Tail kevin spare ribs ground round ham ham hock brisket shoulder. Corned beef tri-tip leberkas flank sausage ham hock filet mignon beef ribs pancetta turkey.
            </p>
            <p>
                Bacon ipsum dolor sit amet landjaeger sausage brisket, jerky drumstick fatback boudin.
            </p>
            </section>
        
            <section id="content4">
            <p>
                Bacon ipsum dolor sit amet landjaeger sausage brisket, jerky drumstick fatback boudin.
            </p>
            <p>
                Jerky jowl pork chop tongue, kielbasa shank venison. Capicola shank pig ribeye leberkas filet mignon brisket beef kevin tenderloin porchetta. Capicola fatback venison shank kielbasa, drumstick ribeye landjaeger beef kevin tail meatball pastrami prosciutto pancetta. Tail kevin spare ribs ground round ham ham hock brisket shoulder. Corned beef tri-tip leberkas flank sausage ham hock filet mignon beef ribs pancetta turkey.
            </p>
            </section>
            
            
        </main>
    
    </body>
</html>
