
<link href="{{ asset('css/library/tab.css') }}" rel="stylesheet">
<link href="{{ asset('css/library/links.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
@php
    $user = Auth::user();
@endphp
<div >
    <div class="card">     
      <div class="card-body">
        <ul class="navbar">
          <li>
            <a  class="tab active" data-id="status-0">
              <span class="icon"><i class='bx bx-home-alt-2' ></i></span>
              <span class="text">ALL</span>
            </a>
          </li>
          <li>
            <a  class="tab" data-id="status-1">
              <span class="icon"><i class='bx bx-dice-2' ></i></span>
              <span class="text">Using</span>
            </a>
          </li>
          <li>
            <a  class="tab" data-id="status-2">
              <span class="icon"><i class='bx bx-dice-3' ></i></span>
              <span class="text">Coming Soon</span>
            </a>
          </li>
          <li>
              <a  class="tab" data-id="status-3">
                <span class="icon"><i class='bx bx-dice-4' ></i></span>
                <span class="text">Not Enough Visits</span>
              </a>
          </li>
          <li>
            <a  class="tab" data-id="status-4">
              <span class="icon"><i class='bx bx-bug' ></i></span>
              <span class="text">Expired</span>
            </a>
          </li>  
          <li>
            <a  class="tab" data-id="status-5" id="tab-5">
              <span class="icon"><i class='bx bx-no-entry' ></i></span>
              <span class="text">No Owner</span>
            </a>
          </li>     
        </ul>
  
        <div class="tab-content" style="min-height: 600px;">
          <div class="tab-pane active box-my-short-links" id="status-0">            
            </div>
            <div class="tab-pane box-my-short-links" id="status-1">           
            </div>
            <div class="tab-pane box-my-short-links" id="status-2">            
            </div>
            <div class="tab-pane box-my-short-links" id="status-3">           
            </div>
            <div class="tab-pane box-my-short-links" id="status-4">              
            </div>
            <div class="tab-pane box-my-short-links" id="status-5">              
            </div>
            </div>
        <div style="padding: 20px;"> <ul class="pagination" id="pagination" style="clear: both"></div>
      </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="modal-edit-short-link" tabindex="-1" aria-labelledby="updateShortLink" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateShortLink">Update Short Link</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" id="form-update-short-link">
        <div class="modal-body">        
          <div class="row box-update-short-link">    
            <div class="col-12">
              <div class="box-input-short-link box-input-short-link-update">
                  <label for="update-title-short-link" class="label-short-link">Title</label>
                  <input type="text" class="w-100 input" name="update_title" id="update-title-short-link" placeholder="Title custom short link (optional)">
                </div>
            </div>                                                      
            <div class="col-lg-6 col-12">
              @php
                  $lock = !$user->checkFeature("Custom shortened link",true);
              @endphp
                <div class="box-input-short-link box-input-short-link-update  {{$lock ? "lock" : ""}}">
                    <label for="update-back-half-short-link" class="label-short-link">Custom back-half</label>
                    <input type="text" class="w-100 input @disabled($lock)" name="update_back_half" id="update-back-half-short-link" placeholder="Custom back-half"{{$lock ? "readonly" : ""}}>
                    @if ($lock)
                        <a href="{{route("premium-register")}}" class="lock-attribute" title="Please upgrade your plan to use this feature"><i class='bx bxs-lock'></i></a>
                    @endif  
                </div> 
            </div> 
            <div class="col-lg-6 col-12">
              @php
                  $lock = !$user->checkFeature("Set limit visits",true);
              @endphp
              <div class="box-input-short-link box-input-short-link-update {{$lock ? "lock" : ""}}">
                  <label for="limit-visits-short-link-update" class="label-short-link">Limit visits</label>
                  <input type="text" class="w-100 input limit-visits-short-link @disabled($lock)" name="update_limit_visits" id="limit-visits-short-link-update" placeholder="Limit visits (optional)" {{$lock ? "readonly" : ""}}>
                  @if ($lock)
                        <a href="{{route("premium-register")}}" class="lock-attribute" title="Please upgrade your plan to use this feature"><i class='bx bxs-lock'></i></a>
                    @endif  
              </div> 
          </div>
          </div>
                  
          <div class=" box-update-short-link row" >                               
            <div class="form-check form-switch check-box-make-an-appointment col-12">
                <input class="form-check-input make-an-appointment" type="checkbox" role="switch" id="update-make-an-appointment" name="make_an_appointment">
                <label class="form-check-label" for="update-make-an-appointment">Make an appointment</label>
            </div>                 
            <div class="col-lg-6 col-12 box-effective-time-short-link" id="box-update-effective-time-short-link" style="display: none">
              @php
                $lock = !$user->checkFeature("Set effective time",true);
              @endphp
                <div class="box-input-short-link box-input-short-link-update {{$lock ? "lock" : ""}}">
                    <label for="update-effective-time-short-link" class="label-short-link">Effective time</label>
                    <input type="datetime-local" class="w-100 input effective-time-short-link @disabled($lock)" name="update_effective_time" id="update-effective-time-short-link" placeholder="Effective time (optional)" {{$lock ? "readonly" : ""}}>
                    @if ($lock)
                        <a href="{{route("premium-register")}}" class="lock-attribute" title="Please upgrade your plan to use this feature"><i class='bx bxs-lock'></i></a>
                    @endif  
                </div> 
            </div>                                                                                                
            <div class="col-lg-12 col-12 box-expired-short-link" id="box-update-expired-short-link">
              @php
                $lock = !$user->checkFeature("Update expired",true);
              @endphp
                <div class="box-input-short-link box-input-short-link-update {{$lock ? "lock" : ""}}" >
                    <label for="update-expired-short-link" class="label-short-link">Expire on</label>
                    <input type="datetime-local" class="w-100 input expired-short-link @disabled($lock)" name="update_expired" id="update-expired-short-link" placeholder="Expire on" {{$lock ? "readonly" : ""}}>
                    @if ($lock)
                        <a href="{{route("premium-register")}}" class="lock-attribute" title="Please upgrade your plan to use this feature"><i class='bx bxs-lock'></i></a>
                    @endif  
                </div>
            </div>                                                                                                                                        
          </div> 
          
            <div class="form-check form-switch check-box-set-password col-12">
              <input class="form-check-input" type="checkbox" role="switch" id="check-box-set-password" name="check_box_set_password">
              <label class="form-check-label" for="check-box-set-password">Set password</label>               
            </div>
          <div class="row box-update-short-link box-update-short-link-set-password">
            <div class="col-12">
              @php
                $lock = !$user->checkFeature("Set password",true);
              @endphp
              <div class="box-input-short-link box-input-short-link-update {{$lock ? "lock" : ""}}" >
                <label for="password" class="label-short-link">Password</label>
                <input type="password" class="w-100 input @disabled($lock)" name="update_password" id="password" placeholder="Password short link" {{$lock ? "readonly" : ""}}>
                @if ($lock)
                    <a href="{{route("premium-register")}}" class="lock-attribute" title="Please upgrade your plan to use this feature"><i class='bx bxs-lock'></i></a>
                @else
                <div class="box-show-password">
                  <input type="checkbox" name="show_password_short_link" id="show-password-short-link" hidden>
                  <label for="show-password-short-link" id="label-show-password-short-link-update">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgb(151, 151, 151);transform: ;msFilter:;">
                      <path d="M12 4.998c-1.836 0-3.356.389-4.617.971L3.707 2.293 2.293 3.707l3.315 3.316c-2.613 1.952-3.543 4.618-3.557 4.66l-.105.316.105.316C2.073 12.382 4.367 19 12 19c1.835 0 3.354-.389 4.615-.971l3.678 3.678 1.414-1.414-3.317-3.317c2.614-1.952 3.545-4.618 3.559-4.66l.105-.316-.105-.316c-.022-.068-2.316-6.686-9.949-6.686zM4.074 12c.103-.236.274-.586.521-.989l5.867 5.867C6.249 16.23 4.523 13.035 4.074 12zm9.247 4.907-7.48-7.481a8.138 8.138 0 0 1 1.188-.982l8.055 8.054a8.835 8.835 0 0 1-1.763.409zm3.648-1.352-1.541-1.541c.354-.596.572-1.28.572-2.015 0-.474-.099-.924-.255-1.349A.983.983 0 0 1 15 11a1 1 0 0 1-1-1c0-.439.288-.802.682-.936A3.97 3.97 0 0 0 12 7.999c-.735 0-1.419.218-2.015.572l-1.07-1.07A9.292 9.292 0 0 1 12 6.998c5.351 0 7.425 3.847 7.926 5a8.573 8.573 0 0 1-2.957 3.557z"></path>
                    </svg>                    
                  </label>
                </div>
                @endif                 

              </div>    
            </div>
            {{-- <div class="col-lg-6 col-12">
              <div class="box-input-short-link box-input-short-link-update" >
                <label for="password-confirmation" class="label-short-link">Repeat your password</label>
                <input type="password" class="w-100 input " name="update_password_confirmation" id="password-confirmation" placeholder="Repeat your password">
              </div>    
            </div> --}}
            {{-- <div class="col-12">
              <input type="checkbox" name="show_password_short_link" id="show-password-short-link">
              <label for="show-password-short-link">Show password</label>
            </div> --}}
          </div>   
          <div class="box-show-error-validate box-show-error-validate-update">
            <span class="error-validate-short-link" id="error-validate-short-link-update" style="display: none"></span>
          </div>       
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="{{asset("js/library/tab.js")}}"></script>
<script src="{{asset("js/handle/manager/links/index.js")}}"></script>