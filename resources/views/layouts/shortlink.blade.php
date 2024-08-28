<link rel="stylesheet" href="{{asset('css/library/tabcustom.css')}}">
<link rel="stylesheet" href="{{asset('css/library/shortlink.css')}}">
<script type="text/javascript" src="{{asset('js/callapi/shortlink/index.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
<style>
    #box-show-qrcode{
        width: 400px;
    }
    .btn-login{        
        font-size: 25px;
    }
    .tell-you-this{
        color: color: var(--bs-light-text-emphasis);
    }
    .lock-attribute{
        position: absolute;
        right: 10;
        top: 50%;
        transform: translateY(-50%);
    }
    .box-input-short-link.lock .label-short-link{
        color: var(--bs-primary-bg-subtle);
        background-color: var(--bs-dark-border-subtle);
        border-radius: 8px;
    }
    .box-input-short-link.lock .input{
        color: #AAAAAA;
        background-color: var(--bs-dark-border-subtle);
        cursor: not-allowed;
    }
    .lock-attribute i{
        font-size: 30px;
    }
</style>
@php
    $user = Auth::user();
@endphp
<div>
    <div class="body-flex">
        <div class="box-center">
            <div class="tabss w-100">
                <div class="tab-itemm activee">
                    <i class='bx bx-link bx-tada' ></i>
                    Short Link
                </div>
                <div class="tab-itemm" id="btn-qrcode">
                    <i class='bx bx-qr-scan bx-tada' ></i>
                    QR Code
                </div>
                <div class="tab-itemm ">
                    <i class='bx bx-git-merge bx-tada' ></i>
                    Link-info
                </div>
                <div class="line"></div>
            </div>
            <div class="w-100" style="border-bottom:1px solid #AAAAAA"></div>
            <div class="tab-contentt w-100">                
                <div class="tab-panee activee">      
                    <form method="post" id="form-short-link">
                        @if(Auth::check() && $user->isVerify())
                        {{-- <div class="box-short-link">
                            <input type="text" class="w-100 input input-link" name="link" id="input-link" placeholder="crustea.id.vn">                                                      
                        </div> --}}
                        <div class="box-short-link">
                            <div class="box-input-short-link">
                                <label for="input-link" class="label-short-link">Original link</label>
                                <input type="text" class="w-100 input input-link" name="link" id="input-link" placeholder="crustea.id.vn/this-is-a-super-long-link-that-is-unrivaled-in-the-universe">  
                            </div>
                        </div>
                        <div style="clear: both"></div>
                        <div class="box-custom-short-link row">  
                            <div class="col-12">
                                <div class="box-input-short-link ">
                                    <label for="title-short-link" class="label-short-link">Title</label>
                                    <input type="text" class="w-100 input" name="title" id="title-short-link" placeholder="Title custom short link (optional)">
                                </div>
                            </div>
                            <div>
                                <br>
                                @if($user->getCountCustomLinksRemainingInCycle()>0)
                                    <h6 id="count-custom-link-title" title="You have {{$user->getCountCustomLinksRemainingInCycle()}} times left to customize link in this cycle">Number of link customizations remaining in this cycle: {{$user->getCountCustomLinksRemainingInCycle()}}</h6>                                                                
                                @else
                                    <h6 id="count-custom-link-title">You have no more link customizations in this cycle</h6>                                                                
                                @endif                                
                            </div>                                                   
                            <div class="col-lg-6 col-12">
                                @php                                
                                    $lock = !$user->checkFeature("Custom shortened link");
                                    $lockByPackage = $user->checkFeature("Custom shortened link",true);                                                                        
                                    $mess = "You have used up all your custom turns in this cycle";
                                    $messUpgrade = "Please upgrade your plan to use this feature";
                                    $href = 'href='.route('premium-register');   
                                @endphp
                                <br>
                                <div class="box-input-short-link {{$lock ? "lock" : ""}}">
                                    <label for="back-half-short-link" class="label-short-link">Custom back-half</label>
                                    <input type="text" class="w-100 input @disabled($lock)" name="back_half" id="back-half-short-link" placeholder="{{$lockByPackage ? "Not enough turns" : "Custom back-half (optional)"}}" {{$lock ? "readonly" : ""}}>
                                    @if ($lock)
                                        <a {{!$lockByPackage ? $href : ""}} class="lock-attribute" title="{{$lockByPackage ? $mess : $messUpgrade}}"><i class='bx bxs-lock'></i></a>
                                    @endif                                                                                                       
                                </div>
                            </div> 
                            <div class="col-lg-6 col-12">
                                @php
                                    $lock = !$user->checkFeature("Set limit visits");
                                    $lockByPackage = $user->checkFeature("Set limit visits",true);
                                @endphp
                                <br>
                                <div class="box-input-short-link {{$lock ? "lock" : ""}}">
                                    <label for="limit-visits-short-link" class="label-short-link">Limit visits (optional)</label>
                                    <input type="text" class="w-100 input limit-visits-short-link @disabled($lock)" name="limit_visits" id="limit-visits-short-link" placeholder="{{$lockByPackage ? "Not enough turns" : "Limit visits"}}" {{$lock ? "readonly" : ""}}>
                                    @if ($lock)
                                        <a {{!$lockByPackage ? $href : ""}} class="lock-attribute" title="{{$lockByPackage ? $mess : $messUpgrade}}"><i class='bx bxs-lock'></i></a>
                                    @endif                                     
                                </div> 
                            </div>                                                                                   
                        </div> 
                        <div class="box-custom-short-link row">                               
                            <div class="form-check form-switch check-box-make-an-appointment col-12">
                                <input class="form-check-input make-an-appointment" type="checkbox" role="switch" name="make_an_appointment" value="true">
                                <label class="form-check-label" for="make-an-appointment">Make an appointment</label>
                            </div>                 
                            <div class="col-lg-6 col-12 box-effective-time-short-link"style="display: none">
                                @php
                                    $lock = !$user->checkFeature("Set effective time");
                                    $lockByPackage = $user->checkFeature("Set effective time",true);
                                @endphp
                                <div class="box-input-short-link  {{$lock ? "lock" : ""}}">
                                    <label for="effective-time-short-link" class="label-short-link">Effective time</label>
                                    <input type="{{$lock ? "text" : "datetime-local"}}" class="w-100 input effective-time-short-link @disabled($lock)" name="effective_time" id="effective-time-short-link" placeholder="{{$lockByPackage ? "Not enough turns" : "Effective time (option)"}}" {{$lock ? "readonly" : ""}}>
                                    @if ($lock)
                                        <a {{!$lockByPackage ? $href : ""}} class="lock-attribute" title="{{$lockByPackage ? $mess : $messUpgrade}}"><i class='bx bxs-lock'></i></a>
                                    @endif
                                </div> 
                                <br>
                            </div>                                                                                                
                            <div class="col-lg-12 col-12 box-expired-short-link">
                                @php
                                    $lock = !$user->checkFeature("Set expired");
                                    $lockByPackage = $user->checkFeature("Set expired",true);                                    
                                @endphp
                                <div class="box-input-short-link  {{$lock ? "lock" : ""}}" >
                                    <label for="expired-short-link" class="label-short-link">Expire on (default: {{$user->premium->link_lifespan}} days)</label>
                                    <input type="{{$lock ? "text" : "datetime-local"}}" class="w-100 input expired-short-link @disabled($lock)" name="expired" id="expired-short-link" placeholder="{{$lockByPackage ? "Not enough turns" : "Expire on"}}" {{$lock ? "readonly" : ""}}>
                                    @if ($lock)
                                        <a {{!$lockByPackage ? $href : ""}} class="lock-attribute" title="{{$lockByPackage ? $mess : $messUpgrade}}"><i class='bx bxs-lock'></i></a>
                                    @endif
                                </div>
                            </div>                                                                                                                
                        </div> 
                        <div class="box-show-error-validate">
                            <span class="error-validate-short-link" style="display: none" id="error-validate-short-link-insert"></span>
                        </div>
                        <button id="btn-short-link" type="submit" class="btn-short-link w-100">Short URL</button>  
                        <div class="box-show-shorted-link">
                            <input type="text" class="w-100 input" id="input-shorted-link" placeholder="crustea.id.vn/resutl" readonly>
                        </div>
                        @else
                            <div class="box-short-link w-100">
                                <input type="text" class="w-75 input input-link" name="link" id="input-link" placeholder="crustea.id.vn/this-is-a-super-long-link-that-is-unrivaled-in-the-universe">
                                <button id="btn-short-link" type="submit" class="btn-short-link w-25">Short URL</button>
                                <div class="box-show-shorted-link">
                                    <input type="text" class="w-100 input" id="input-shorted-link" placeholder="crustea.id.vn/resutl" readonly>
                                </div>
                            </div>
                            @if(Auth::check())
                                <center><p class="tell-you-this">Tell you this: Please verify your email so you can edit your short link yourself -,-</p></center>
                            @else
                            <center><p class="tell-you-this">Log in to use more features -,-</p></center>                            
                            @endif
                        @endif
                    </form>                                   
                </div>
                <div class="tab-panee tab-qrcode"> 
                    <br> 
                    <center>
                        <div id="box-show-qrcode">
                            {{QrCode::format("svg")->size(200)->generate(url("/"))}}
                        </div>
                    </center>
                    <br>  
                    @if(!Auth::check() || !$user->isVerify())                        
                        <center>                                                      
                            @if (!Auth::check())
                                <a href="{{route("login")}}" class="btn btn-outline-warning btn-login"> <i class='bx bx-log-in bx-tada bx-flip-vertical' style="font-size: 30px;"></i>Login so you can generate QR Code</a>                                              
                            @else
                                <a href="{{route("web.personal-links-index")}}" class="btn btn-outline-warning btn-login"><i class='bx bx-bulb bx-tada bx-flip-vertical' style="font-size: 30px;" ></i>Verify your email to generate a QR code</a>                                              
                            @endif                            
                        </center><br>
                    @else
                        <center>                                                                               
                            @if ($user->getCountCreateQRCodeRemainingInCycle()<1)
                                <h4>You have used up all uses create QR Code for this cycle</h4>
                            @else
                                <h4>Enter the link in the Short Link tab and click through to get the QR Code</h4>
                            @endif                            
                        </center>
                    @endif
                </div>
                <div class="tab-panee"> 
                    <center><h3>The feature is in development, please wait a little longer</h3></center>
                </div>                
            </div>
        </div>
        <div style="clear: both"></div>
    </div>    
</div>
<script type="text/javascript" src="{{asset('js/library/tabcustom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/handle/shortlink/index.js')}}"></script>