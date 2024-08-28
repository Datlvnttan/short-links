@extends('layouts.app')
@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @php
        $user = Auth::user()    
    @endphp
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-lg" style="position: relative">
          <a class="navbar-brand" href="/">Crustea</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route("premium-register")}}">Premium</a>
              </li> 
              @if(!$user)
                <li class="nav-item">
                    <a class="nav-link" href="/auth/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("register")}}">Register</a>
                </li>
                
              @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route("web.personal-links-index")}}">{{$user->full_name}}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route("logout")}}">Logout</a>
              </li>
              @endif                                                     
            </ul>            
            <div class="form-check form-switch" style="position: absolute; right: 0;">              
              <input class="form-check-input" type="checkbox" role="switch" id="theme-toggle" value="true">
              <label class="form-check-label" for="theme-toggle" class="theme-toggle">Dark</label>
              <script src="{{asset('js/library/change-theme.js')}}"></script>              
            </div> 
          </div>
        </div>
      </nav>
    <div >
        @yield("content")
    </div>
{{-- <script src="{{ asset('js/callapi/auth/login.js') }}"></script>
<script src="{{ asset('js/handle/auth/login.js') }}"></script> --}}
</body>
</html>
@endsection