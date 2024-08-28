<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EmailApiController;
use App\Http\Controllers\Api\FeatureApiController;
use App\Http\Controllers\Api\PermissionApiController;
use App\Http\Controllers\Api\PremiumApiController;
use App\Http\Controllers\Api\PremiumFeatureApiController;
use App\Http\Controllers\Api\QRCodeApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\ShortLinkApiController;
use App\Http\Controllers\Api\ShortLinkManagerApiController;
use App\Http\Controllers\Api\ShortLinkPersonalApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post("/parse",[
    ShortLinkApiController::class,
    "parse"
]);
Route::get("/setting/maximum-term-expired",[
    ShortLinkApiController::class,
    "getMaximumTermExpired"
]);


Route::post("/verify/{id}/{token}",[
    EmailApiController::class,
    "verifyEmail"
]);
Route::group(['middleware'=>['api']],function($request){
    Route::group(['prefix'=>'auth'],function(){
        route::post('/login',[
            AuthApiController::class,
            'login'
        ]);
        Route::get('logout', [
            AuthApiController::class,
            'logout'
        ]);//->name("logout");
        Route::post('refresh', [
            AuthApiController::class,
            'refresh'
        ]);
        Route::post('me', [
            AuthApiController::class,
            'me'
        ]);
        Route::post('register', [
            AuthApiController::class,
            'register'
        ]);
    });



      

    Route::controller(PremiumApiController::class)->group(function(){
        Route::group(['prefix'=>'premium'],function () {
            Route::get("/","index");  
            Route::get("/{id}","show")->where("id","[0-9]+");  
            Route::get("get-level","getLevel");  
        });
    });

    // Route::get("premium",[
    //     PremiumApiController::class,
    //     "index"
    // ]);


    Route::group(['prefix'=>'feature'],function () {
        Route::get("get-by-premium-level",[
            FeatureApiController::class,
            "getDataByPremiumLevel"
        ]);  
        Route::get("get-by-follow-premium",[
            FeatureApiController::class,
            "getDataByFollowPremium"
        ]); 
        Route::get("get-by-follow-premium-id",[
            FeatureApiController::class,
            "getDataByFollowPremiumId"
        ]); 
        
    });

    Route::group(['prefix'=>'personal','middleware'=>['auth:api']],function () {
        Route::post("resend-verify-email",[
            EmailApiController::class,
            "reSendVerifyEmail"
        ]);  
        Route::post("top-up-money",[
            UserApiController::class,
            "topUpMoney"
        ]);
    });
    // Route::controller(PremiumFeatureApiController::class)->group(function(){
    //     Route::group(["prefix"=> "premium-feature"],function(){
    //         Route::get("get-by-premium","getByPremium")->name("api.manager-premium-feature-get-by-premium");
    //     });
    // });
    Route::group(['middleware'=>['auth.jwt']],function(){                          
        Route::resource('role', RoleApiController::class)->name("index","api.role_get");
        //Route::resource('manager-user', UserApiController::class);
        Route::group(['prefix'=>'manager'],function(){




                 
            Route::apiResource("premium",PremiumApiController::class)->only(["store","update","destroy"])->names([                            
                "store"=>"api.manager-premium-create",
                "update"=>"api.manager-premium-update",
                "destroy"=>"api.manager-premium-delete"
            ]);
             
             Route::controller(PremiumFeatureApiController::class)->group(function(){
                Route::group(["prefix"=> "premium-feature"],function(){                    
                    Route::put("update-status","updateStatus")->name("api.manager-premium-feature-update-status");                
                    Route::put("create-delete","createOrDelete")->name("api.manager-premium-feature-create-or-delete");                                    
                });
            });                
            

            // //chưa làm khởi tạo   
            // Route::post("premium/register",[
            //     UserApiController::class,
            //     "registerPremium"
            // ])->name("api.manager-premium-register");


            Route::apiResource("links",ShortLinkManagerApiController::class)->names([
                "index"=>"api.manager-links-index",
                "update"=>"api.manager-links-update",
                "destroy"=>"api.manager-links-delete"
            ]);  
            Route::apiResource("role",RoleApiController::class)->names([
                "index"=>"api.manager-role-index",
                "update"=>"api.manager-role-update",
                "destroy"=>"api.manager-role-delete"
            ]);  

            Route::group(['prefix'=>'permission'],function(){              
                route::get("get-by-role",
                    [
                        PermissionApiController::class,
                        'getDataByRole'
                    ]
                )->name("api.manager-permission-get-by-role"); 
                route::put("update-status",
                    [
                        PermissionApiController::class,
                        'updateStatus'
                    ]
                )->name("api.manager-permission-update-status");  
            });  


            route::resource('users', UserApiController::class)->names([
                "index"=>"api.manager-users-index",
                "update"=>"api.manager-users-update",
                "destroy"=>"api.manager-users-delete",
            ]);  
            route::delete('users',[
                    UserApiController::class,
                    "deletes"
                ])->name("api.manager-users-deletes");
            });   
        });


        Route::group(['prefix'=>'personal'],function(){            
            Route::get("infomation",[
                UserApiController::class,
                "infomation"
            ])->name("api.personal-infomation");    
            Route::put("infomation",[
                UserApiController::class,
                "update"
            ])->name("api.personal-infomation-update");  
            Route::put("change-password",[
                UserApiController::class,
                "changePassword"
            ])->name("api.personal-infomation-change-password"); 



            Route::apiResource("links",ShortLinkPersonalApiController::class)->names([
                "index"=>"api.personal-links-index",
                "update"=>"api.personal-links-update",
                "destroy"=>"api.personal-links-delete"
            ]);  

            Route::controller(QRCodeApiController::class)->group(function(){
                Route::get('qrcode/{shortened_link}',"show")->name("api.personal-qrcode-show");        
            });                           
        });
        
});