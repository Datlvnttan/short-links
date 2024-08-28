@extends('layouts.layoutmain')
@section('content')
<style>
    .error-validate
    {
        font-size: 13px; 
        color:red;
        position: absolute;
        bottom: -17px; 
    }
    .form-outline{
        position: relative;
    }
</style>
{{-- <!-- <link href="{{ asset('css/home/login.css') }}" rel="stylesheet"> --> --}}
<!-- Section: Design Block -->
{{-- style="background-color: #9A616D;" --}}
<section class="vh-100" >
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
  
                  <form class="mx-1 mx-md-4" id="form-register">
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Your Name</label>
                        <input type="text" id="form3Example1c" class="form-control"  name="full_name"/>                        
                        <span class="error-validate" id="error_full_name"></span>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <input type="email" id="form3Example3c" class="form-control" name="email" />  
                        <span class="error-validate" id="error_email"></span>                      
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c">Password</label>
                        <input type="password" id="form3Example4c" class="form-control" name="password"/>
                        <span class="error-validate" id="error_password"></span>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                        <input type="password" id="form3Example4cd" class="form-control"  name="password_confirmation"/>
                        <span class="error-validate" id="error_password_confirmation"></span>
                      </div>
                    </div>
  
                    {{-- <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                      <label class="form-check-label" for="form2Example3">
                        I agree all statements in <a href="#!">Terms of service</a>
                      </label>
                    </div> --}}
  
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-warning btn-lg" >Register</button>
                    </div>
  
                  </form>
  
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                  <div class="w-100 h-100" style="background: url(https://cdn.yespo.io/photos/shares/Blog/blogs/link-shortener.png); background-size: cover"></div>
                  {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image"> --}}

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<script src="{{ asset('js/callapi/home/register.js') }}"></script>
<script src="{{ asset('js/handle/home/register.js') }}"></script>
@endsection