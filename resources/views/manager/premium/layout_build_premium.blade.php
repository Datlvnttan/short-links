@extends('layouts.layoutmanager')
@section('content')
<script src="{{asset('js/callapi/manager/premium_feature/premium.js')}}"></script>
<script src="{{asset('js/callapi/feature/getdata.js')}}"></script>
<form action="" method="POST" id="form-create-permium">
    <div class="header">
        <div class="left">
            <h1 id="title">Create Premium</h1>           
        </div>        
        <button id="btn-save" class="report" type="submit">
            <i class='bx bx-check-double' ></i>
            <span>Save</span>
        </button>
        <div class="box-create-premium box-white">
            <br>
            <form action="" method="POST" id="form-create-primium">  
                <div class="row p-4">
                    <div class="col-lg-6 col-12">
                        <div class="box-input-update">
                            <label class="label-input-update" for="premium_name">Name <span class="required-field">*</span></label>
                            <input class="input-update" type="text" name="premium_name" id="premium_name">
                            <span class="error-validate-update premium_name"></span>
                        </div>
                    </div>        
                    <div class="col-lg-6 col-12">
                        <div class="box-input-update">
                            <label class="label-input-update" for="premium_title">Title <span class="required-field">*</span></label>
                            <input class="input-update" type="text" name="premium_title" id="premium_title">
                            <span class="error-validate-update premium_title"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-sm-6">
                        <div class="box-input-update">
                            <label class="label-input-update" for="billing_cycle">Billing Cycle <span class="required-field">*</span></label>
                            <input class="input-update numeric" type="text" name="billing_cycle" id="billing_cycle">
                            <span class="error-validate-update billing_cycle"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-sm-6">
                        <div class="box-input-update">
                            <label class="label-input-update" for="upgrade_costs">Upgrade Costs <span class="required-field">*</span></label>
                            <input class="input-update numeric" type="text" name="upgrade_costs" id="upgrade_costs">
                            <span class="error-validate-update upgrade_costs"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-sm-6">
                        <div class="box-input-update">
                            <label class="label-input-update" for="level">Level <span class="required-field">*</span></label>
                            <select class="input-update select" name="level" id="level">                                              
                            </select>
                            <span class="error-validate-update level"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-sm-6">
                        <div class="box-input-update">
                            <label class="label-input-update" for="link_lifespan">Link Lifespan <span class="required-field">*</span></label>
                            <input class="input-update numeric" type="text" name="link_lifespan" id="link_lifespan">
                            <span class="error-validate-update link_lifespan"></span>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4 col-sm-6">
                        <div class="box-input-update">
                            <label class="label-input-update" for="limit_create_custom_link">Limit Custom Link <span class="required-field">*</span></label>
                            <input class="input-update numeric" type="text" name="limit_create_custom_link" id="limit_create_custom_link">
                            <span class="error-validate-update limit_create_custom_link"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-sm-6">
                        <div class="box-input-update">
                            <label class="label-input-update" for="limit_create_qrcode">Limit QR Code <span class="required-field">*</span></label>
                            <input class="input-update numeric" type="text" name="limit_create_qrcode" id="limit_create_qrcode">
                            <span class="error-validate-update limit_create_qrcode"></span>
                        </div>
                    </div>
                    <div class="box-show-feature" style="display: none">
                        <center><h4>The package's feature list is to a lesser extent</h4></center>
                        <table class="table table-hover table-striped table-bordered" border="1">
                            <tr>
                                <th>Premium level</th>
                                <th>Feature Name</th>
                                <th>Feature Title</th>
                                <th>Attribute</th>
                                <th>Option</th>
                            </tr>
                            <tbody id="body-data-feature">
    
                            </tbody>
                        </table>
                    </div>            
                </div>
            </form>  
        </div>
        {{-- <div class="w-100">
            <table class="table table-hover table-striped table-bordered" border="1" >
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Title</td>                              
                        <td>Level</td>
                        <td>Billing Cycle</td>
                        <td>Upgrade Costs</td>
                        <td>Limit Create Custom Link</td>
                        <td>Limit Create QR Code</td>
                        <td>Link Lifespan</td> 
                        <td class="td-show-btn"></td>                                      
                    </tr>
                </thead>
                <tbody id="body-show-premiums">
    
                </tbody>
            </table>
        </div> --}}
    </div>    
</form>
{{-- <script src="{{asset('js/handle/manager/premium/index.js')}}"></script> --}}
<script src="{{asset('js/handle/manager/premium/create.js')}}"></script>
@endsection


