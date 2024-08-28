<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Feature;
use App\Models\GroupRoute;
use App\Models\Permission;
use App\Models\Premium;
use App\Models\PremiumFeature;
use App\Models\Role;
use App\Models\Route;
use App\Models\RouteListGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            

        //route
        //web.api
        Route::create([
            'route_name'=>"personal-links-index",
            'route_title'=>"Quyền truy cập danh sách short link của cá nhân",
            'interface_name'=>"My Links",
            'icon'=>'bx-link'
        ]);
        Route::create([
            'route_name'=>"personal-links-update",
            'route_title'=>"Quyền cập nhật dữ liệu cho short link của cá nhân"
        ]);
        Route::create([
            'route_name'=>"personal-links-delete",
            'route_title'=>"Quyền xóa short link của cá nhân"
        ]);
        Route::create([
            "route_name"=> "personal-qrcode-show",
            'route_title'=>"Quyền truy cập và tạo QRCode của cá nhân"
        ]);

        GroupRoute::create([
            "group_route_name"=>"My links",
            "group_route_title"=>"Quyền truy cập và thiết lập link cá nhân",
            'default'=>true,
        ]);  

        $group_route_id = GroupRoute::where("group_route_name","My links")->first()->id;
        $route_id = Route::where("route_name","personal-links-index")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);        
        $route_id = Route::where("route_name","personal-links-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);        
        $route_id = Route::where("route_name","personal-links-delete")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);        
        $route_id = Route::where("route_name","personal-qrcode-show")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        






        //personal home
        //web
        Route::create([
            'route_name'=>"personal-home",
            'route_title'=>"Quyền truy cập vào trang quản lý tải khoản cá nhân"
        ]);


       
        //info
        //web.api
        Route::create([
            'route_name'=>"personal-infomation",
            'route_title'=>"Quyền xem thông tin cá nhân",
            'interface_name'=>"Account",
            'icon'=>'bx-cog'
        ]);   
        Route::create([
            'route_name'=>"personal-infomation-update",
            'route_title'=>"Quyền chỉnh sửa thông tin cá nhân"
        ]);   
        Route::create([
            'route_name'=>"personal-infomation-change-password",
            'route_title'=>"Quyền cập nhật mật khẩu cá nhân"
        ]);   

        GroupRoute::create([
            "group_route_name"=>"Infomation",
            "group_route_title"=>"Quyền truy cập, quản lý thông tin cá nhân",
            'default'=>true,
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Infomation")->first()->id;
        $route_id = Route::where("route_name","personal-infomation")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        $route_id = Route::where("route_name","personal-infomation-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);  
        $route_id = Route::where("route_name","personal-infomation-change-password")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);   


        //manager        
        //manager links
        //web.api
        Route::create([
            'route_name'=>"manager-links-index",
            'route_title'=>"Quyền quản lý tất cả các link",
            'interface_name'=>"Links",
            'icon'=>'bx-link-alt'            
        ]);

        Route::create([
            'route_name'=>"manager-links-update",
            'route_title'=>"Quyền update 1 link bất kì"
        ]);

        Route::create([
            'route_name'=>"manager-links-delete",
            'route_title'=>"Quyền xóa 1 link bất kì"
        ]);

        GroupRoute::create([
            "group_route_name"=>"Links Selecter",
            "group_route_title"=>"Quyền truy cập (xem) danh sách tất cả các liên kết của hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Links Selecter")->first()->id;
        $route_id = Route::where("route_name","manager-links-index")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 

        GroupRoute::create([
            "group_route_name"=>"Links Editer",
            "group_route_title"=>"Quyền cập nhật thuộc tính của tất cả các liên kết trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Links Editer")->first()->id;  
        $route_id = Route::where("route_name","manager-links-index")->first()->id;      
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-links-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);


        GroupRoute::create([
            "group_route_name"=>"Links Edit Deleter",
            "group_route_title"=>"Quyền xem, cập nhật và xóa tất cả các liên kết trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Links Edit Deleter")->first()->id; 
        $route_id = Route::where("route_name","manager-links-index")->first()->id;       
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-links-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-links-delete")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);



        Route::create([
            'route_name'=>"manager-role-index",
            'route_title'=>"Quản lý vai trò và các gói người dùng",
            'interface_name'=>"Roles",
            'icon'=>'bxl-redux'   
        ]);
        Route::create([
            'route_name'=>"manager-role-update",
            'route_title'=>"Quyền update vai trò"
        ]);
        Route::create([
            'route_name'=>"manager-role-delete",
            'route_title'=>"Quyền xóa 1 vai trò bất kì"
        ]);                       

        GroupRoute::create([
            "group_route_name"=>"Roles Selecter",
            "group_route_title"=>"Quyền truy cập (xem) tất cả các vai trò trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Roles Selecter")->first()->id;     
        $route_id = Route::where("route_name","manager-role-index")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);



        GroupRoute::create([
            "group_route_name"=>"Roles Editer",
            "group_route_title"=>"Quyền cập nhật thuộc tính của tất cả các vai trò trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Roles Editer")->first()->id;  
        $route_id = Route::where("route_name","manager-role-index")->first()->id;      
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-role-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);


        GroupRoute::create([
            "group_route_name"=>"Roles Edit Deleter",
            "group_route_title"=>"Quyền xem, cập nhật và xóa tất cả các vai trò trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Links Edit Deleter")->first()->id; 
        $route_id = Route::where("route_name","manager-role-index")->first()->id;       
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-role-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-role-delete")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);





        //manager permission
        Route::create([
            'route_name'=>"manager-permission-grant",
            'route_title'=>"Quyền truy cập giao diện web quản lý phân quyền",
            'interface_name'=>"Permission",
            'icon'=>"bxl-graphql"
        ]);
        Route::create([
            'route_name'=>"manager-permission-get-by-role",
            'route_title'=>"Phân quyền"
        ]);       
        Route::create([
            'route_name'=>"manager-permission-update-status",
            'route_title'=>"Quyền cập nhật trạng thái nhóm vai trò"
        ]);


        GroupRoute::create([
            "group_route_name"=>"Permission Selecter",
            "group_route_title"=>"Quyền truy cập (xem) tất cả các phân quyền theo vai trò trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Permission Selecter")->first()->id;     
        $route_id = Route::where("route_name","manager-role-index")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-permission-grant")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-permission-get-by-role")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);


        GroupRoute::create([
            "group_route_name"=>"Permission Editer",
            "group_route_title"=>"Quyền truy cập và cập nhật trạng thái các nhóm vai trò (phân quyền)"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Permission Editer")->first()->id;     
        $route_id = Route::where("route_name","manager-role-index")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-permission-grant")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-permission-get-by-role")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-permission-update-status")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);        





        //manager user
        //web.api
        Route::create([
            'route_name'=>"manager-users-index",
            'route_title'=>"Quản lý danh sách user",
            'interface_name'=>"Users",
            'icon'=>"bx-group"
        ]);    
        Route::create([
            'route_name'=>"manager-users-update",
            'route_title'=>"Cập nhật thông tin user",            
        ]);     
        Route::create([
            'route_name'=>"manager-users-delete",
            'route_title'=>"Xóa 1 user bất kì",            
        ]);    
        Route::create([
            'route_name'=>"manager-users-deletes",//cái này khác cái trên nga
            'route_title'=>"Xóa nhiều user cùng lúc",        
        ]);  
        

        GroupRoute::create([
            "group_route_name"=>"Users Selecter",
            "group_route_title"=>"Quyền truy cập (xem) tất cả các tài khoản người dùng trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Users Selecter")->first()->id;     
        $route_id = Route::where("route_name","manager-users-index")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);


        GroupRoute::create([
            "group_route_name"=>"Users Editer",
            "group_route_title"=>"Quyền cập nhật thuộc tính của tài khoản người dùng trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Users Editer")->first()->id;  
        $route_id = Route::where("route_name","manager-users-index")->first()->id;            
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-users-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);


        GroupRoute::create([
            "group_route_name"=>"Users Edit Deleter",
            "group_route_title"=>"Quyền xem, cập nhật và xóa tất cả các tài khoản người dùng trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Users Edit Deleter")->first()->id; 
        $route_id = Route::where("route_name","manager-users-index")->first()->id;        
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-users-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-users-delete")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-users-deletes")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);

    


        

        //manager dashboard
        //web.api
        Route::create([
            'route_name'=>"manager-dashboard",
            'route_title'=>"Quản lý thiết lập thông số trang web",
            'interface_name'=>"Dashboard",
            'icon'=>"bxs-dashboard"
        ]);

        GroupRoute::create([
            "group_route_name"=>"Dashboard Manager",
            "group_route_title"=>"Quyền thiết lập các thông số, thuộc tính của toàn hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Dashboard Manager")->first()->id;     
        $route_id = Route::where("route_name","manager-dashboard")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        $route_id = Route::where("route_name","manager-role-index")->first()->id;       
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-role-update")->first()->id;
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);


        //manager premium
        //web.api
        Route::create([
            'route_name'=>"manager-premium-index",
            'route_title'=>"Truy cập giao diện quản lý các gói premium",
            'interface_name'=>"Premiums",
            'icon'=>"bxs-coin"
        ]);
        GroupRoute::create([
            "group_route_name"=>"Premium Feature Selecter",
            "group_route_title"=>"Quyền truy cập (xem) tất cả các gói premium trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Premium Feature Selecter")->first()->id;     
        $route_id = Route::where("route_name","manager-premium-index")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        Route::create([
            'route_name'=>"manager-premium-feature-index",
            'route_title'=>"Quyền truy cập giao diện quản lý phân chia tính năng cho các gói premium",            
            'interface_name'=>"Allocate Feature",
            'icon'=>"bx-podcast"
        ]);
        $route_id = Route::where("route_name","manager-premium-feature-index")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 




        Route::create([
            'route_name'=>"manager-premium-create",
            'route_title'=>"Quyền tạo các gói premium",            
        ]);
        Route::create([
            'route_name'=>"manager-premium-update",
            'route_title'=>"Quyền cập nhật thông tin các gói premium",            
        ]);
        Route::create([
            'route_name'=>"manager-premium-delete",
            'route_title'=>"Quyền xóa các gói premium",            
        ]);
        Route::create([
            'route_name'=>"manager-premium-feature-update-status",
            'route_title'=>"Quyền cập nhật trạng thái các tính năng cho các gói premium trong hệ thống",            
        ]);
        Route::create([
            'route_name'=>"manager-premium-feature-create-or-delete",
            'route_title'=>"Quyền thiết lặp các tính năng cho các gói premium",            
        ]);
        GroupRoute::create([
            "group_route_name"=>"Premium Feature Manager",
            "group_route_title"=>"Quyền xem, cập nhật và xóa các gói premium và thiết lập các tính năng liên quan trong hệ thống"
        ]);
        $group_route_id = GroupRoute::where("group_route_name","Premium Feature Manager")->first()->id;     
        $route_id = Route::where("route_name","manager-premium-index")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        $route_id = Route::where("route_name","manager-premium-create")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        $route_id = Route::where("route_name","manager-premium-update")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        $route_id = Route::where("route_name","manager-premium-delete")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]);
        $route_id = Route::where("route_name","manager-premium-feature-index")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        $route_id = Route::where("route_name","manager-premium-feature-update-status")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        $route_id = Route::where("route_name","manager-premium-feature-create-or-delete")->first()->id;          
        RouteListGroup::create([
            "group_route_id"=>$group_route_id,
            "route_id"=>$route_id,
        ]); 
        
        
                       
        //Feature dành cho set up các gói người dùng
        Feature::create([
            'feature_name'=>"Set effective time",
            'feature_title'=>"Tính năng lập thời gian hiệu lực cho short link",
            'attribute'=>'effective_time'
        ]); 
        Feature::create([
            'feature_name'=>"Custom shortened link",
            'feature_title'=>"Tính năng cho phép thiết kế nữa sau tùy chỉnh của short link",
            'attribute'=>'shortened_link'
        ]);
        Feature::create([
            'feature_name'=>"Set expired",
            'feature_title'=>"Tính năng đặt thời hạn sử dụng tùy chỉnh của short link",
            'attribute'=>'expired'
        ]);
        Feature::create([
            'feature_name'=>"Update expired",
            'feature_title'=>"Tính năng cập nhật lại thời hạn sử dụng của short link",
            'attribute'=>'expired'
        ]);
        Feature::create([
            'feature_name'=>"Set limit visits",
            'feature_title'=>"Tính năng lập giới hạn số lượt truy cập",
            'attribute'=>'limit_visits'
        ]);
        Feature::create([
            'feature_name'=>"Set password",
            'feature_title'=>"Tính năng đặt mật khẩu cho short link",
            'attribute'=>'password'
        ]);        
        Premium::create([
            'premium_name'=>"Free",
            'premium_title'=>"For everyone",            
            'level'=>1,        
            'billing_cycle'=>30,    
            'upgrade_costs'=>0,
            'limit_create_custom_link'=>15,
            'limit_create_qrcode'=>5,
            'link_lifespan'=>7,
        ]);
        $premium_id = Premium::where("level",1)->first()->id;                        

        $feature = Feature::all();
        for ($i = 0; $i < count($feature); $i++)
        {
            PremiumFeature::create([
                'premium_id'=>$premium_id,
                'feature_id'=>$feature[$i]->id,
                'status'=>1
            ]);
        }       
        Role::create([
            'role_name'=>"admin",
            'role_manager'=>true,
            'priority'=>1,
            'lock'=>true            
        ]);
        Role::create([
            'role_name'=>"edit",
            'role_manager'=>true,
            'priority'=>2,            
        ]);
        Role::create([
            'role_name'=>"user",            
            'priority'=>3, 
            'lock'=>true                          
        ]);

        $role_id = Role::orderBy('priority')->first()->id;
        User::create([
            "username"=>"master",
            "full_name"=>"Lê Phát Đạt",
            "email"=>"Datlvnttan@gmail.com",
            "password"=>"123",
            "phone_number"=>"0387079343",
            "role_id"=>$role_id,
            "premium_id"=>$premium_id,
            'premium_register_date'=>Carbon::now(),
            "token"=>Str::random(20),
            "status"=>true,            
        ]);        
        $groupRoutes = GroupRoute::where("default",false)->get();
        foreach ($groupRoutes as $groupRoute) {
            Permission::create([
                "role_id"=>$role_id,
                "group_route_id"=>$groupRoute->id,
                "status"=>true,
                "lock"=>true
            ]);
        }


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
