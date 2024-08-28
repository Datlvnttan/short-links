@extends('layouts.layoutmain')
@section('content')
<style>
  .error-validate{
    color: red;
    position: absolute;
  }
</style>
<!-- <link href="{{ asset('css/home/login.css') }}" rel="stylesheet"> -->
<!-- Section: Design Block -->
<section class="vh-100" style="">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <div class="w-100 h-100" style="background: url(https://cdn.yespo.io/photos/shares/Blog/blogs/link-shortener.png); background-size: cover"></div>
              {{-- <img src=""
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" /> --}}
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="post" id="form-login">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class='bx bxl-graphql' ></i>
                    <span class="h1 fw-bold mb-0">Crustea</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <input type="text" id="form2Example17" name="fieldvalue" placeholder="Email, phone number or login name" class="form-control form-control-lg" required />
                    <!-- <label class="form-label" for="form2Example17">User name</label> -->
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" placeholder="Password" name="password" id="form2Example27" class="form-control form-control-lg" required />
                    <!-- <label class="form-label" for="form2Example27">Password</label> -->
                    <span class="error-validate" id="error-validate"></span>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-warning btn-lg btn-block w-100" type="submit">Login</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="/auth/register"
                      style="color: #393f81;">Register here</a></p>
                  {{-- <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a> --}}
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="{{ asset('js/callapi/home/login.js') }}"></script>
<script src="{{ asset('js/handle/home/login.js') }}"></script>
@endsection