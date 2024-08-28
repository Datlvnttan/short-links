@extends('layouts.app')
@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/library/sidebar-manager.css') }}" rel="stylesheet">
    @php
        $user = Auth::user()    
    @endphp
    <style>
        .form-check-status{
            position: relative;
            display: flex;
            flex-wrap: wrap;
            justify-items: center;
            justify-content: center;
            align-items: center;
        }
        .container-overflow{
            height: 100%;
            overflow: auto;
        }
        .btn-create-short-link{
            border: 1px solid var(--warning);
            cursor: pointer;
        }
        .btn-create-short-link:hover{
            border: 1px solid var(--bs-primary-border-subtle);
        }
        .label-show-update{
            font-size: 20px;
            cursor: pointer;
        }
        .td-show-btn{
            width:60px;
        }
        .box-input-update{
            position: relative;
            margin-bottom:45px; 
        }
        .label-input-update{
            position: absolute;
            background: var(--bs-body-bg);            
            top: -20;
            left: 10px;
            padding: 0 10;
            border-radius: 5px;
        }
        .input-update{
            width: 100%;
            height: 50px;
            border-radius: 5px;
            font-size: 20px;
            background: var(--bs-body-bg); 
            padding: 0 10;
            /* border: 1px solid var(--bs-primary-border-subtle); */
            border: 1px solid black;  
        }
        .input-update.numeric,
        .input-update.select{
            text-align: center;
        }
        .error-validate-update{
            color: red;
            position: absolute;
            bottom: -20;
            left: 5;
        }
        table{
            align-content:center;
            text-align:center;
            justify-content:center;
            align-items:center;            
        }
        .required-field{
            color: crimson;
            font-size: 22px;
        }
    </style>
</head>
{{-- {{dd($user->getRouteInterfaces())}} --}}
<body >   

    <!-- Sidebar -->
    <div class="sidebar close">
        <a href="/" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Crus</span>tea</div>
        </a>       
        <ul class="side-menu p-0">           
            <li><a class="bg-warning btn-create-short-link" data-bs-toggle="modal" data-bs-target="#modal-create-short-link"> <i class='bx bx-add-to-queue'></i> Create link</a></li>                
            @foreach ($user->getRouteInterfaces() as $route)                   
                <li title="{{$route->interface_name}}" class="{{request()->is(str_replace(url('/')."/", '', route("web.".$route->route_name))) ? 'active' :'' }} "><a href="{{route("web.".$route->route_name)}}"><i class='bx {{$route->icon}}'></i>{{$route->interface_name}}</a></li>
            @endforeach            
            {{-- <li class="{{request()->is('manager/dashboard') ? 'active' :'' }} "><a href="{{route("web.manager-dashboard")}}"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="{{request()->is('manager/links/index') ? 'active' :'' }} "><a href="{{route("web.manager-links-index")}}"><i class='bx bx-link-alt' ></i></i>Links</a></li>  
            <li class="{{request()->is('personal/links/index') ? 'active' :'' }} "><a href="{{route("web.personal-links-index")}}"><i class='bx bx-link' ></i></i>My links</a></li>                                                                                         
            <li class="{{request()->is('manager/user') ? 'active' :'' }} "><a href="{{route("web.manager-users-index")}}"><i class='bx bx-group'></i>Users</a></li>            
            <li class="{{request()->is('manager/permission/grant') ? 'active' :'' }} "><a href="{{route("web.manager-permission-grant")}}"><i class='bx bxl-graphql' ></i></i>Permission</a></li>
            <li class="{{request()->is('personal/infomation') ? 'active' :'' }} "><a href="{{route("web.personal-infomation")}}"><i class='bx bx-cog'></i>Account</a></li>                            --}}
        </ul>
        <ul class="side-menu p-0">
            <li>
                <a href="{{route("logout")}}" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->
    
    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form >
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>         
            <script src="{{asset('js/library/change-theme.js')}}"></script>    
            {{-- <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a> --}}
            <a href="#" class="notif">
                <i class='bx bx-dollar-circle'></i>
                <span class="count"></span>
            </a>
            <a href="" class="profile">
                <img src="{{asset("img/user.png")}}">
                {{$user->full_name}}
            </a>
            
        </nav>         
        <main class="container">            
            @if(!$user->isVerify())
            <script src="{{asset("js/callapi/auth/verify_email.js")}}"></script>
                <style>
                    .box-message-confim-email{                        
                        border: 1px solid #006488;
                        border-radius: 5px;
                        margin-bottom: 20px;
                        background-color: var(--light);
                    }
                    .title-message-confim-email{
                        color: var(--primary);
                        font-size: 17px;
                    }
                   .box-close-mes{
                    display: flex;
                    justify-content: center;
                    align-items: center;
                   }
                   .box-message-confim-email-title,
                   .icon-close{
                    padding: 20px;
                    border:none;
                    border-radius: 10px;                    
                   }
                   .title-message-confim-email:hover{
                        color: #006488;
                   }
                   .btn-re-send-verify-email:hover{
                        color: var(--primary);
                   }
                </style>
                <script src="{{asset("js/handle/auth/verify_email.js")}}"></script>
                <div id="box-show-message-verify-email">
                    <script>
                        buildMessageVerifyEmail();
                    </script>
                </div>                                         
            @endif            
            <section >
                @yield('content')
            </section>
        </main>   
    </div>




    <div class="modal fade" id="modal-create-short-link" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <center>Short Link</center>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="min-height: 800px;">                
                <div class="p-lg-5">
                    @include("layouts.shortlink")
                </div>
            </div>
            <div class="modal-footer">                  
            </div>
          </div>
        </div>
      </div>    
<script src="{{asset('js/library/sidebar-manager.js')}}"></script>
</body>
</html>
@endsection