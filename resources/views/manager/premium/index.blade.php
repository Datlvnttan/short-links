@extends('layouts.layoutmanager')
@section('content')
<script src="{{asset('js/callapi/manager/premium_feature/premium.js')}}"></script>
<div class="header">
    <div class="left">
        <h1>Premiums</h1>
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
    <a href="{{route("web.manager-premium-create")}}" class="report">
        <i class='bx bx-plus'></i>
        <span>Create</span>
    </a>
</div>

<div class="box-show-premium box-white p-4">
    <table class="table table-hover table-striped table-bordered" border="1">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Title</th>                              
                <th>Level</th>
                <th>Billing Cycle</th>
                <th>Upgrade Costs</th>
                <th>Limit Create Custom Link</th>
                <th>Limit Create QR Code</th>
                <th>Link Lifespan</th> 
                <th class="td-show-btn"></th>                                      
            </tr>
        </thead>
        <tbody id="body-show-premiums">

        </tbody>
    </table>
</div>
<script src="{{asset('js/handle/manager/premium/index.js')}}"></script>
@endsection


