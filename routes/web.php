<?php

use App\Http\Controllers\Api\PremiumApiController;
use App\Http\Controllers\Api\ShortLinkPersonalApiController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\View\AuthController;
use App\Http\Controllers\View\EmailController;
use App\Http\Controllers\View\HomeController;
use App\Http\Controllers\View\PermissionController;
use App\Http\Controllers\View\PersonalController;
use App\Http\Controllers\View\PremiumController;
use App\Http\Controllers\View\PremiumFeatureController;
use App\Http\Controllers\View\RoleController;
use App\Http\Controllers\View\ShortLinkController;
use App\Http\Controllers\View\ShortLinkManagerController;
use App\Http\Controllers\View\ShortLinkPersonalController;
use App\Http\Controllers\View\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/run/run',[
    HomeController::class,
    "run"
]);

Route::get('/verify/{id}/{token}',[
    EmailController::class,
    "verifyEmail"
])->name("revify-email");
Route::get('/',[
    HomeController::class,
    "index"
]);
Route::get("/{shortened_link}",[
    ShortLinkController::class,
    "redirect"
]);
Route::post("/{shortened_link}",[
    ShortLinkController::class,
    "redirect"
]);

Route::group(['prefix'=>'auth'],function(){
    Route::get("login",[
        AuthController::class,
        "login"
    ])->name("login");
    Route::get("logout",[
        AuthController::class,
        "logout"
    ])->name("logout");
    Route::get("register",[
        AuthController::class,
        "register"
    ])->name("register");
});





Route::group(['prefix'=>'payment-gateway'],function(){
    Route::controller(PaymentGatewayController::class)->group(function(){  
        Route::post("momo","gatewayMomo")->name("payment-gateway-momo");                          
        // Route::get("show","show")->name("premium-show");        
    });
});

//Cần xem xét lại
Route::group(['prefix'=>'premium'],function(){
    Route::controller(PremiumController::class)->group(function(){  
        Route::get("register","register")->name("premium-register");                          
        Route::get("show","show")->name("premium-show");        
        Route::get("register-success","registerSuccess")->name('premium-register-success');        
    });
});
Route::middleware(["auth","authorization"])->group(function(){
    Route::group(['prefix'=>'manager'],function(){

     
        Route::group(['prefix'=>'premium'],function(){
            Route::controller(PremiumController::class)->group(function(){                
                Route::get("/","index")->name("web.manager-premium-index");   //cái này là giao diện quản lý các gói
                Route::get("build","create")->name("web.manager-premium-create");   //cái này là giao diện tạo gói
                Route::get("/{id}","edit")->name("web.manager-premium-update");   //cái này là giao diện tạo gói
            });
        });
        
        
        //name = Allocate feature
        Route::get("premium-feature",[
            PremiumFeatureController::class,
            "index"
        ])->name("web.manager-premium-feature-index");   //cái này là giao diện quản lý phân bổ các gói        


        
        Route::get('role',[
            RoleController::class,
            "index"
        ])->name("web.manager-role-index");
        

        Route::group(['prefix'=>'links'],function(){
            Route::get("index",[
                ShortLinkManagerController::class,
                "index"
            ])->name("web.manager-links-index");
            // Route::get("/{id}",[
            //     ShortLinkManagerController::class,
            //     "show"
            // ])->name("web.manager-links-show");                 
        });    


        Route::group(['prefix'=>'permission'], function(){
            Route::get("/grant",[
                PermissionController::class,
                "grant"
            ])->name("web.manager-permission-grant");
        });

        Route::get("dashboard",[
            ManagerController::class,
            "index"
        ])->name("web.manager-dashboard");

        Route::get("user",[
            UserController::class,
            "index"
        ])->name("web.manager-users-index");     

    });
    Route::group(['prefix'=>'personal'],function(){
        Route::get("home",[
            PersonalController::class,
            "index"
        ])->name("web.personal-home"); 

        Route::get("infomation",[
            PersonalController::class,
            "infomation"
        ])->name("web.personal-infomation");  


        Route::group(['prefix'=>'links'],function(){
            Route::get("index",[
                ShortLinkPersonalController::class,
                "index"
            ])->name("web.personal-links-index");

            // Route::get("/{id}",[
            //     ShortLinkPersonalController::class,
            //     "show"
            // ])->name("web.personal-links-show");                 
        });    
    });
    
});




