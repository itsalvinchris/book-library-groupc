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

                if($('#tab5').is(':checked')) { 
                    $("#content5").css({ display: "block" });
                }

                $('#book_table').DataTable({columnDefs: [
                    { targets: 'no-sort', orderable: false }
                ]});

                $(".dataTables_length").replaceWith(function(){
                    return '<button id="btn-add" data-toggle="modal" href="#modal-id" class="btn btn-danger btn-borrow" style="margin-top: 15px;width: 70px;height: 25px;font-size: 12px;line-height: 12px !important;">Add</button>';
                });

                $('.videoModal').on('hidden.bs.modal', function(e) {
                    console.log('yes')    
                    $('#video-id').get(0).pause();
                });

                $("#library_file").change(function () {
                    var fileExtension = 'mp4';
                    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                        alert("Only formats are allowed : "+fileExtension);
                    }
                });
                $("#video-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings("#file-name").addClass("selected").html(fileName);
                });
                $("#video-file-input-update").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings("#video-file-update").addClass("selected").html(fileName);
                });

                $("#thumb-image").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings("#thumb-name").addClass("selected").html(fileName);
                });

                $("#thumb-update-image").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    console.log(fileName);
                    $(this).siblings("#thumb-update-name").addClass("selected").html(fileName);
                });

                $('#modal-id').on('hidden.bs.modal', function (e) {
                    $("#file-name").removeClass("selected").html("Video File");
                    $("#thumb-name").removeClass("selected").html("Choose Thumbnail");
                    $('#thumb-img').attr('src', "{{url('/images/img-placeholder.png')}}");
                })
                $('#modal-current').on('hidden.bs.modal', function (e) {
                    $("#video-file-update").removeClass("selected").html("Video File (Leave this If dont want to change)");
                    $("#thumb-upate-name").removeClass("selected").html("Choose Thumbnail (Leave this If dont want to change)");
                    $('#thumb-update-img').attr('src', "{{url('/images/img-placeholder.png')}}");
                })

                function readURL(input) {
                    console.log(input.id)
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        if(input.id === "thumb-image"){
                            reader.onload = function (e) {
                                $('#thumb-img').attr('src', e.target.result);
                            }
                        } else if(input.id === "thumb-update-image") {
                            reader.onload = function (e) {
                                $('#thumb-update-img').attr('src', e.target.result);
                            }
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#thumb-image").change(function(){
                    readURL(this);
                });

                $("#thumb-update-image").change(function(){
                    readURL(this);
                });
        
            });

            $(document).on("click", ".btn-delete", function(event){
                const id = this.id;
                const currIndex = id.indexOf("#");
                const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                $('#delete-video-title').html($('#title'+index).html());
                $('#modal-video-delete').attr('action',"{{url('/admin/video/')}}/"+index);
            });

            $(document).on("click", ".btn-edit", function(event){
                const id = event.currentTarget.id;
                const currIndex = id.indexOf("#");
                const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                $("#edit-name-video").val($('#title'+index).html());
                $("#edit-desc").val($('#desc'+index).html());
                $("#thumb-update-img").attr('src', "{{url('storage/')}}/"+$('#thumbnail-path'+index).val());
                $("#modal-video-edit").attr('action',"{{url('/admin/video')}}/"+index);
            });

            $(document).on("click", ".btn-video", function(event){
                const id = this.id;
                const currIndex = id.indexOf("#");
                const index = id.substr(currIndex + 1,id.length - currIndex - 1);
                console.log('hello')
                $('#video-id source').attr('src',"{{url('/storage/')}}"+"/"+$('#video-path'+index).val());
                $('#video-id')[0].load();
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
            
                <input id="tab4" type="radio" name="tabs">
                <label for="tab4"><a href="{{url('/admin/book-status')}}">Book Status</a></label>

                <input id="tab5" type="radio" name="tabs" checked>
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
        
            <section id="content5">
                    <div class="employee">
                        <table class="table text-center custom-table text-nowrap" id="book_table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($videos as $key => $video)
                                    <tr>
                                        <th scope="row">{{++$key}}</th>
                                        <td id="title{{$video->id}}">{{$video->title}}</td>
                                        <td id="desc{{$video->id}}">{{$video->description}}</td>
                                        <td>
                                            <input type="hidden" id="video-path{{$video->id}}" value="{{$video->video}}">
                                            <input type="hidden" id="thumbnail-path{{$video->id}}" value="{{$video->thumbnail}}">
                                            <button id="btn-video#{{$video->id}}" data-toggle="modal" href='#modal-video' class="btn btn-danger btn-video" style="margin: 0 10px;width: 70px;height: 25px;font-size: 12px;line-height: 12px !important;">Watch</button>
                                            <button id="btn-update#{{$video->id}}" data-toggle="modal" href='#modal-current' class="btn btn-danger btn-edit" style="margin: 0 10px;width: 70px;height: 25px;font-size: 12px;line-height: 12px !important;">Update</button>
                                            <button id="btn-delete#{{$video->id}}" data-toggle="modal" href='#modal-delete' class="btn btn-danger btn-delete" style="width: 70px;height: 25px;font-size: 12px;line-height: 12px !important; margin-left: 30px; margin-right: -50px;">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="modal fade" id="modal-id">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                            <h4 class="modal-title">Add Video</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <form action="{{url('admin/video')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{url('/images/img-placeholder.png')}}" id="thumb-img" class="book-image img-responsive text-center"style="width: 300px; height: 300px;"alt="...">
                                            </div>
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input" name="thumb_file" id="thumb-image">
                                                <label class="custom-file-label text-left" for="customFile" id="thumb-name">Choose Thumbnail</label>
                                            </div>
                                            <div class="body-content">
                                                <label for="year">Video Title</label>
                                                <input id="edit-name" type="text" name="video_title">
                        
                                                <label for="description">Description</label>
                                                <textarea required rows="3" id="description" name="video_desc" maxlength="191"></textarea>
                                            </div>
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input" name="video_file" id="video-file-input">
                                                <label class="custom-file-label text-left" for="customFile" id="file-name">Video File</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                        <div class="modal fade" id="modal-current">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 id="edit-modal-title" class="modal-title">Update Video</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <form id="modal-video-edit" action="{{url('/admin')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <div class="modal-body" style="padding: 5px 20px 20px;">
                                            <div class="text-center">
                                                <img src="{{url('/images/img-placeholder.png')}}" id="thumb-update-img" class="book-image img-responsive text-center"style="width: 300px; height: 300px;"alt="...">
                                            </div>
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input" name="thumb_file" id="thumb-update-image">
                                                <label class="custom-file-label text-left" for="customFile" id="thumb-update-name">Choose Thumbnail (Leave this If dont want to change)</label>
                                            </div>
                                            <div class="body-content" style="padding-bottom: 0;">
                                                <label for="year">Video Title</label>
                                                <input id="edit-name-video" type="text" name="video_title">
                        
                                                <label for="description">Description</label>
                                                <textarea id="edit-desc" required rows="3" id="description" name="video_desc" maxlength="191"></textarea>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="video_file" id="video-file-input-update">
                                                <label class="custom-file-label text-left" for="customFile" id="video-file-update">Video File (Leave this If dont want to change)</label>
                                            </div>
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
                                            <h4 for="description">Video Title</h4>
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
                        <div class="modal fade videoModal" id="modal-video">
                            <div class="modal-dialog" style="min-width: 1140px; margin-top: 0;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Video</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-content" style="max-height: 85vh;">    
                                        <video id="video-id" controls>
                                            <source src="{{asset('storage/video/Mars Binusian - YouTube.mp4')}}" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            
            
        </main>
    
    </body>
</html>
