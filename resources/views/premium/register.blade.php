@extends('layouts.layoutmain')
<script src="{{asset('js/callapi/manager/premium_feature/premium.js')}}"></script>
<script src="{{asset('js/callapi/feature/getdata.js')}}"></script>
<style>
   .premium-package{
      padding: 10;
      position: relative;      
      border-radius: 10px;
      opacity: 0.9;
      cursor: pointer;
      border: 1px solid #aaaaaa;
      height: 650px;
   }
   .premium-package:hover{
      border: 1px solid var(--bs-orange);
      opacity: 1;
   }
   .premium-package-header{
      position: relative;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      /* border-bottom: 1px solid #aaaaaa;       */
   }
   .plan-line{
      position: absolute;
      width: 100%;
      border-bottom: 1px dashed #aaaaaa;  
      top: 45%;
      transform: translateY(-50%);
      z-index: 1;
   }
   .plan-level{
      color:var(--bs-danger);
      background-color: var(--bs-light);
      z-index: 34;
      padding: 0 10;
   }
   .plan-name{
      padding: 0 10 5 10;
      font-size: 40px;
   }
   .premium-package-body{
      padding: 5 0;
   }
   .plan-price{
      font-size: 20px;  
      color: var(--bs-primary);    
   }
   .plan-price .plan-upgrade_costs,
   .plan-price  .plan-billing_cycle{     
      color: var(--bs-primary);
      font-weight: 700;      
   }
   .plan-price  .plan-billing_cycle{
      font-size: 35px;
   }
   .plan-benefit-title{
      font-size: 17px;
   }
   .plan-benefit{
      font-weight: 600;   
   }
   .box-plan-name{
      border-top: 1px solid #e7e7e7 ;
      border-bottom: 1px solid #e7e7e7;
      margin: 10 0;
      padding: 10 0;   
   }
   .premiun-package-footer{
      padding: 10px;
      height: 250px;      
   }
   .plan-feature-title{
      font-weight: 500;
      font-size: 17px;
   }
   .box-btn-buy{      
      width: 100%;      
   }
   .btn-buy{
      height: 45px;
      font-size: 20px;
      font-weight: 500;
   }
   .show-full-feature{
      cursor: pointer;
   }
</style>
@section('content')
<div class="container-lg box-white p-4">
   <div class="p-4">
      <form action="{{route("payment-gateway-momo")}}" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">
         @csrf
         <div class="box-show-premium-package row">
            
            {{-- <div class=" col-xxl-3 col-lg-4 col-sm-6 col-12 p-2">
               <div class="premium-package box-shadow">
                  <div class="premium-package-header">               
                     <div class="plan-line"></div> 
                     <center class="plan-level"><h3>Level 1</h3></center>   
                  </div>
                  <div class="premium-package-body">               
                        <center><h4 class="plan-price"><span><span class="plan-billing_cycle">100.000</span> vnđ</span><br><span class="plan-upgrade_costs">month</span></h4></center>
                        <br>
                        <center class="plan-benefit">limit_create_custom_link</center>                  
                        <center class="plan-benefit">limit_create_qrcode</center>
                        <center class="plan-benefit">link_lifespan</center>               
                  </div>
                  <div class="box-plan-name">
                     <center><b class="plan-name">
                        Free
                     </b> </center>                
                  </div>
                  <div class="premiun-package-footer">
                     <p class="plan-feature-title"><b>Everything in Free, plus:</b></p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>               
                  </div>
                  <div class="box-btn-buy">
                     <button class="btn btn-warning w-100 btn-buy">Get Started</button>
                  </div>
               </div>
            </div>  
            <div class=" col-xxl-3 col-lg-4 col-sm-6 col-12 p-2">
               <div class="premium-package box-shadow">
                  <div class="premium-package-header">               
                     <div class="plan-line"></div> 
                     <center class="plan-level"><h3>Level 1</h3></center>   
                  </div>
                  <div class="premium-package-body">               
                        <center><h4 class="plan-price"><span><span class="plan-billing_cycle">100.000</span> vnđ</span><br><span class="plan-upgrade_costs">month</span></h4></center>
                        <br>
                        <center class="plan-benefit">limit_create_custom_link</center>                  
                        <center class="plan-benefit">limit_create_qrcode</center>
                        <center class="plan-benefit">link_lifespan</center>               
                  </div>
                  <div class="box-plan-name">
                     <center><b class="plan-name">
                        Free
                     </b> </center>                
                  </div>
                  <div class="premiun-package-footer">
                     <p class="plan-feature-title"><b>Everything in Free, plus:</b></p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>               
                  </div>
                  <div class="box-btn-buy">
                     <button class="btn btn-warning w-100 btn-buy">Get Started</button>
                  </div>
               </div>
            </div>  
            <div class=" col-xxl-3 col-lg-4 col-sm-6 col-12 p-2">
               <div class="premium-package box-shadow">
                  <div class="premium-package-header">               
                     <div class="plan-line"></div> 
                     <center class="plan-level"><h3>Level 1</h3></center>   
                  </div>
                  <div class="premium-package-body">               
                        <center><h4 class="plan-price"><span><span class="plan-billing_cycle">100.000</span> vnđ</span><br><span class="plan-upgrade_costs">month</span></h4></center>
                        <br>
                        <center class="plan-benefit">limit_create_custom_link</center>                  
                        <center class="plan-benefit">limit_create_qrcode</center>
                        <center class="plan-benefit">link_lifespan</center>               
                  </div>
                  <div class="box-plan-name">
                     <center><b class="plan-name">
                        Free
                     </b> </center>                
                  </div>
                  <div class="premiun-package-footer">
                     <p class="plan-feature-title"><b>Everything in Free, plus:</b></p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>
                     <p class="plan-feature"><i class='bx bx-check-double'></i>Tính năng lập thời gian hiệu lực cho short link</p>               
                  </div>
                  <div class="box-btn-buy">
                     <div class="box-btn-buy">
                     <button class="btn btn-warning w-100 btn-buy">Get Started</button>
                  </div>
                  </div>
               </div>
            </div>   --}}
            
                  

         </div>
      </form>
   </div>   
</div>
<script src="{{asset('js/handle/premium/register.js')}}"></script>
@endsection