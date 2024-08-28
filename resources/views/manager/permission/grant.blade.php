@extends('layouts.layoutmanager')
@section('content')
<script src="{{asset('js/callapi/manager/permission/grant.js')}}"></script>
<script src="{{asset('js/callapi/manager/permission/role.js')}}"></script>
<div class="header">
    <div class="left">
        <h1>Permission</h1>
        <ul class="breadcrumb">
            {{-- <li><a href="#">
                    Analytics
                </a></li>
            /
            <li><a href="#" class="active">Shop</a></li> --}}
        </ul>
    </div>
    {{-- <a href="#" class="report">
        <i class='bx bx-cloud-download'></i>
        <span>Download CSV</span>
    </a> --}}
    <button class="report">
        <i class='bx bx-check-double' ></i>
        <span>Save</span>
    </button>
</div>

<div class="box-select-role">
    <select id="slect-role">
    </select>
</div>
<div class="box-show-permisson-by-role">
    <table class="table table-hover table-striped table-bordered" border="1" style="align-content:center;text-align:center;justify-content:center;align-items:center;">
        <thead>
            <tr>
                <td>Id</td>
                <td>Group Route</td>
                <td>Title</td>                              
                <td>Status</td>
                <td>Updated at</td>                
            </tr>
        </thead>
        <tbody id="table-permisson-by-role-body">

        </tbody>
    </table>
</div>
<script src="{{asset('js/handle/manager/permission/grant.js')}}"></script>
@endsection


