@extends('layouts.layoutmanager')
@section('content')
<script src="{{asset("js/callapi/personal/link.js")}}"></script>

<h1>My Links </h1>
@include('layouts.body_links')
{{-- <script src="{{asset("js/handle/personal/links/index.js")}}"></script> --}}
<script>  
  $("#tab-5").find(".text").text("Use password")    
  $("#tab-5").find(".icon").html(`<i class='bx bx-lock-alt'></i>`)  
</script>
@endsection
