<link href="{{ asset('css/library/bootstrap.css') }}" rel="stylesheet">
<script src="{{ asset('js/library/bootstrap.js') }}"></script>
<style>
    .box-shadow{
        background-color: var(--bs-light);
        border-radius: 10px;
        box-shadow: 1px 4px 10px #AAAAAA;
    }
    .box-white{        
        background-color: var(--bs-light);
        border-radius: 10px;
    }
    .page-item{        
        cursor: pointer;
    }
    input[type="checkbox"]:checked{
            background-color: rgb(255, 166, 0)!important;
            box-shadow: 1px 1px 2px rgb(255, 166, 0);
            border: 1px solid #fb7500;
        }
    select option:hover {
        background-color: rgb(255, 166, 0)!important;
        color: #000; /* Màu chữ cho tùy chọn đã chọn */
    }
    .border-error{
        border-color: red !important;
    }
    input{
        color: var(--bs-light-text-emphasis);
    }
    *{
        color: var(--bs-light-text-emphasis);
    }  
    i{
        color: var(--bs-light-text-emphasis) !important;
    } 
</style>

<!-- {{-- <script src="https://kit.fontawesome.com/213b585f79.js" crossorigin="anonymous"></script> --}} -->
<!-- Jquery -->
<script rel="stylesheet" src="{{ asset('js/library/jquery.min.js') }}"></script>

<!--toastMessage-->
<link rel="stylesheet" href="{{asset('css/library/toastmessage.css')}}" />    
<link rel="stylesheet" href="{{asset('css/library/message-box.css')}}" />    

<!--config setup-->
<script  rel="stylesheet" src="{{asset('js/config/config.js')}}"></script>

<!--pagination-->
<script  rel="stylesheet" src="{{asset('js/library/pagination.js')}}"></script>

<!--Message Box-->
<script src="{{asset('js/library/message-box.js')}}"></script>
<!--Helper-->
<script src="{{asset('js/library/helper.js')}}"></script>

<!--Icon-->
{{-- <script src="https://unpkg.com/@phosphor-icons/web"></script> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">



<!-- ##### notifications ##### -->
<ul class="notifications"></ul>
@yield('main') 
<!-- Toastmessage -->
<script type="text/javascript" src="{{asset('js/library/toastmessage.js')}}"></script>   