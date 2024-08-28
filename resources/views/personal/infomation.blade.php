@extends('layouts.layoutmanager')
@section('content')
<style>
    .box-info{
        min-height: 600px;
        padding: 20px;
        position: relative;
    }
    .box-information-input{
        position: relative;
        padding: 20px 10px;
    }
    .information-label{
        position: absolute;
        background: var(--bs-body-bg);
        top: 7;
        left: 20px;
        padding: 0 5;   
        cursor: pointer; 
        border-radius: 5px; 
    }
    .information-input{
        width: 100%;
        text-align: center;
        height: 45px;
        border-radius:5px;
        border: 1px solid black; 
        cursor: default;   
        background-color: var(--bs-body-bg); 
    }
    .error-information{
        font-size: 13px;
        color: red;
        position: absolute;
        bottom: 0;
        left: 11;
        display: none;
    }
    .information-input.error-information-input{
        border: 1px solid red;
    }
    input.information-input-hover:hover{
        border: 1px solid #f7b500;
        cursor: auto;     
    }
    .information-input:focus{
        border: 1px solid #f7b500;     
    }
    div.information-input{
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10%;
    }
    .information-input.information-input-don-hover:hover{
        border: 1px solid black; 
    }
    .item-gender{
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 3px;
    }
    .box-image-avatar{
        position: relative;
    }
    .image-avatar{    
        display: block;
        width: 100%;
        height: 300px;
        border-left:1px solid var(--bs-light-text-emphasis);   
        border-right:1px solid var(--bs-light-text-emphasis);  
        border-top:1px solid var(--bs-light-text-emphasis);   
    }
    .information-title{
        color:#f7b500;
        background-color: black;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding: 10px;
        font-size: 17px;
    }
    #input-joining-date{
        cursor: default;
    }
    .box-account-link{
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;    
    }
    .box-button{
        padding: 20px 30px;
        position: absolute;
        bottom: 0;
    }
    .btn-update{
        float: right;
        width: 110px;
    }
    .box-btn-choose-avatar{
        position: relative;
        display: flex;
        justify-content: center;
        cursor: pointer;
    }
    .btn-update-avatar{
        width: 100%;
        font-size:17px;
        background-color: #f7cf62;
        color: black;
        border-bottom-left-radius: 5px;  
        border-bottom-right-radius: 5px;  
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: 1px solid black;
        border-top:none;
        padding: 5px 10px;
    }
    .information-input-hover:hover{
        border: 1px solid #f7b500;     
    }
    .box-drop-drag-avatar{
        width: 100%;
        border: 3px dashed #f7b500;
        border-radius: 10px;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        overflow: hidden;
        position: relative;
    }
    .title-choose-avatar{
        width: 100%;
        text-align: center;
        color: var(--bs-light-text-emphasis);   
    }
    #btn-choose-avatar{
        padding: 5px 10px;
        width: 100px;
        border-radius: 5px;
        background-color: #f7b500;    
    }
    .box-operation-choose-avatar{
        margin: 10 0;
        min-height: 70px;
    }
    .box-show-avatar{    
        top: 0;    
        min-width:100%; 
        height: 100%;          
    }
    .avatar-preview{
        border-top-left-radius:5px; 
        border-top-right-radius:5px; 
        height: 100%;    
    }
    .box-image-avatar{
        border-right: 1px solid #000; 
        border-bottom: 1px solid #000;  
        border-left: 1px solid #000;  
        margin-left:12px;  
        border-bottom-left-radius: 5px;      
        border-bottom-right-radius: 5px;      
    }
    .item-image-avatar{        
        padding-top:10px; 
        padding-bottom:10px;
        color: crimson; 
    }
    .item-remove-avatar{
        position: absolute;
        top: 0;
        right: 0;
        cursor: pointer;
        opacity: 0;
    }
    .image-avatar:hover .item-remove-avatar{
        opacity: 1;
    }
    @media (max-width:991px){ 
        .box-button{
            position: sticky;
            width: 100%;     
            bottom: 0px;        
        }   
        .btn-update{
            background-color: var(--bs-light-text-emphasis);
        }
    }
    @media (max-width:767px){
        .item-image-avatar{
            padding: 0;
        }
        .box-image-avatar{
            border: none;
            margin:0;
        }
        .item-remove-avatar{
            right: 12px;
            top: 1px;
        }    
    }
    .btn-update-password{
            position: absolute;
            right: 10;
            border-right: none;
            border: 1px solid var(--bs-light-text-emphasis);
            border-radius:5px; 
            background-color: var(--bs-light);
            opacity: 0;
            transition: all 0.3s;
            height: 45px;
        }
    .information-input:hover .btn-update-password{
        opacity: 1;      
        width: auto;
    }
    .btn-update-password:hover{
        border: 1px solid #f7b500;
    }
    .border-message{
            border: 1px solid red;        
        }
    .box-show-password{
        margin-left: 10px;
    }
</style>
<div class="header">
    <div class="left">
        <h1>Profile</h1>
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
    {{-- <button class="report">
        <i class='bx bx-check-double' ></i>
        <span>Save</span>
    </button> --}}
</div>
    <div class="container">
        <div class="box-white box-info">
            {{-- <div class="information-title">Profile</div>  --}}                                                           
            <div class="row p-0">
                <div class="col-lg-6">
                    <div class="box-information-input">
                        <label for="input-username" class="information-label">Username</label>
                        <input id="input-username" class="information-input readonly" name="username" type="text" placeholder="Username">
                        <span class="error-information" id="error-input-username"></span>
                    </div>   
                    <div class="box-information-input">
                        <label for="input-full-name" class="information-label">Full name</label>
                        <input id="input-full-name" class="information-input readonly" type="text" name="full_name" placeholder="Full name">
                        <span class="error-information" id="error-input-full-name"></span>
                    </div>                              
                    <div class="box-information-input">
                        <label for="input-email" class="information-label">Email</label>
                        <input id="input-email" class="information-input readonly" type="Email" name="email" placeholder="email@example.com">
                        <span class="error-information" id="error-input-email"></span>
                    </div>                                    
                </div>
                <div class="col-lg-6">
                    {{-- <div class="box-information-input">
                        <label for="input-date-of-birth" class="information-label">Ngày sinh</label>
                        <input id="input-date-of-birth" class="information-input" type="date" name="ngay_sinh" placeholder="dd/MM/yyyy">
                        <span class="error-information" id="error-input-date-of-birth"></span>
                    </div> 
                    <div class="box-information-input">
                        <label class="information-label">Giới tính</label>
                        <div class="information-input ">
                            <div class="item-gender">
                                <input type="radio" value="Nam" id="radio-gender-male" name="gioi_tinh" disabled>
                                <label for="radio-gender-male">Nam</label> 
                            </div> 
                            <div class="item-gender">
                                <input type="radio" value="Nữ" id="radio-gender-female" name="gioi_tinh" disabled>     
                                <label for="radio-gender-female">Nữ</label>                             
                            </div>                                                        
                            <div class="item-gender">
                                <input type="radio" value="Khác" id="radio-gender-other" name="gioi_tinh" disabled>    
                                <label for="radio-gender-other">Khác</label>                             
                            </div>                                                                                
                        </div>
                        <span class="error-information" id="error-input-gender"></span>
                    </div>  --}}
                    <div class="box-information-input">
                        <label for="input-phone-number" class="information-label">Phone number</label>
                        <input id="input-phone-number" maxlength="10" class="information-input readonly" type="text" name="so_dien_thoai" placeholder="Phone number" maxlength="10">
                        <span class="error-information" id="error-input-phone-number"></span>
                    </div> 
                    <div class="box-information-input">
                        <label class="information-label">Password</label>
                        <div class="information-input information-input-don-hover">
                            <div id="input-password"></div>
                            <button class="btn-update-password" data-bs-toggle="modal" data-bs-target="#modal-change-password">Change</button>
                        </div>                            
                    </div>
                    <div class="box-information-input">
                        <label class="information-label">Join date</label>
                        <div id="input-joining-date" class="information-input information-input-don-hover">24/04/2023</div>
                    </div> 
                </div>
                <div class="col-12">
                    <div class="box-information-input">
                        <div class="information-input information-input-don-hover">
                            <div id="input-amount-of-money">999.999.999 đ</div>
                            <button class="btn-update-password" data-bs-toggle="modal" data-bs-target="#modal-top-up-money">Top up</button>
                        </div>   
                    </div> 
                </div>
                <div class="box-button">
                    <input type="checkbox" name="update-data" id="update-data-information" hidden>
                    <label class="btn-update btn btn-outline-dark" for="update-data-information">Change</label>                    
                </div>
            </div>                                              
                                                                                            
        </div>
    </div>
    <div class="modal fade" id="modal-change-password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <center>Change password</center>
              <button type="button" class="btn-close" id="btn-modal-change-password-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="post" id="form-change-password">
                <div class="modal-body" style="height: 350px;">
                    <div class="box-information-input">
                        <label for="input-old-password" class="information-label">Password</label>
                        <input id="input-old-password" maxlength="10" class="information-input password" type="password" name="old_password" placeholder="Old Password" >
                        <span class="error-information" id="error-input-old-password"></span>
                    </div> 
                    <div class="box-information-input">
                        <label for="input-new-password" class="information-label">New password</label>
                        <input id="input-new-password" maxlength="10" class="information-input password" type="password" name="new_password" placeholder="New Password">
                        <span class="error-information" id="error-input-new-password"></span>
                    </div> 
                    <div class="box-information-input">
                        <label for="input-new-password-confirmation" class="information-label">Re-type New Password</label>
                        <input id="input-new-password-confirmation" maxlength="10" class="information-input password" type="password" name="new_password_confirmation" placeholder="Re-type New Password" >
                        <span class="error-information" id="error-input-new-password-confirmation"></span>
                    </div> 
                    <div class="box-show-password">
                        <input type="checkbox" id="show-password">
                        <label for="show-password">Show password</label>
                    </div>
                </div>
                <div class="modal-footer">   
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" >Save</button>               
                </div>
            </form>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modal-top-up-money" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <center>Top up</center>
              <button type="button" class="btn-close" id="btn-modal-change-password-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="post" id="form-top-up-money">
                <div class="modal-body" style="height: 350px;">
                    <div class="box-information-input">
                        <label for="input-money" class="information-label">Enter the amount you want to load</label>
                        <input id="input-up-to-money" maxlength="10" class="information-input password" type="number" min="10000" name="top_up" placeholder="minimum: 10.000vnđ" >
                        <span class="error-information" id="error-input-up-to-money"></span>
                    </div> 
                </div>
                <div class="modal-footer">   
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" >Up</button>               
                </div>
            </form>
          </div>
        </div>
    </div>
    
    <script src="{{asset("js/callapi/personal/information.js")}}"></script>
    <script src="{{asset("js/handle/personal/information.js")}}"></script>
    

@endsection