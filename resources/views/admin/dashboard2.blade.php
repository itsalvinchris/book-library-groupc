@extends('layouts.admin')

@section('home-active-dropdown')
active
@endsection

@section('product-active')
active-color
@endsection

{{-- @section('subtitle')
Edit Home Page
@endsection --}}

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jquery.dataTables.css')}}">
<link rel="stylesheet" href="{{ asset('css/admin/customdashboard.css')}}">
@endsection

@section('js')
@parent
{{-- <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script> --}}
<script type="text/javascript">
    jQuery(document).ready(function($) {

        $(".btn-show").click( (event) => {
            const id = event.currentTarget.id;
            const currIndex = id.indexOf("#");
            const index = id.substr(currIndex + 1,id.length - currIndex - 1);
        });

    });
</script>
@endsection

@section('content')
<div class="employee">
    Asu
    
</div>

@endsection