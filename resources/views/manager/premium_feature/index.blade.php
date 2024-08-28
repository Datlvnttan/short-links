@extends('layouts.layoutmanager')
@section('content')
<script src="{{asset('js/callapi/manager/premium_feature/premium_feature.js')}}"></script>
<script src="{{asset('js/callapi/manager/premium_feature/premium.js')}}"></script>
<script src="{{asset('js/callapi/feature/getdata.js')}}"></script>
<style>
    .form-check-status{
        position: relative;
        display: flex;
        flex-wrap: wrap;
        justify-items: center;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="header">
    <div class="left">
        <h1>Allocate feature</h1>
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
        <span>Create</span>
    </button>
</div>

<div class="box-select-premium">
    <select id="slect-premium">
    </select>
</div>
<div class="box-show-permisson-by-role">
    <table class="table table-hover table-striped table-bordered" border="1" style="align-content:center;text-align:center;justify-content:center;align-items:center;">
        <thead>
            <tr>
                <td>Level</td>
                <td>Premium Name</td>                                         
                <td>Feature Name</td>
                <td>Feature Title</td>                
                <td>Attribute</td>                
                <td></td>  
                <td>Updated at</td>                                              
            </tr>
        </thead>
        <tbody id="table-permisson-by-role-body">

        </tbody>
    </table>
</div>
<script src="{{asset('js/handle/manager/premium_feature/index.js')}}"></script>
@endsection


