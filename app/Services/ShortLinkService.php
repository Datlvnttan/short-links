<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Models\User;
use Carbon\Carbon;
use Str;

class ShortLinkService
{
    public static function getMaximumTermExpired()
    {       
        $user = auth()->user();                        
        return isset($user) ? $user->premium->link_lifespan : config("setting.EXPIRED_SHORT_LINK_DEFAULT",3);       
    }    
    public static function parse($shortUrlRepo,$userRepo,$data)
    {
        // return ResponseJson::success(data:$data); 
        if(!isset($data["link"]))
            return ResponseJson::failed("Original link cannot be empty",422);
        // return ResponseJson::success(data:$data['link']);
        if(filter_var($data['link'], FILTER_VALIDATE_URL) || filter_var("https://".$data['link'], FILTER_VALIDATE_URL) || filter_var("http://".$data['link'], FILTER_VALIDATE_URL))
        {            
            // if(!isset($data['back_half']) && !isset($data['effective_time']) && !isset($data['expired']) && (!isset($data['title']) || trim($data['title']) == ''))
            // {
            //     $short_url = $shortUrlRepo->findBy("original_link",$data['link'])->first();
            //     if(isset($short_url))
            //         return ResponseJson::success(data:$short_url); 
            // }           
            $short_url["original_link"]=$data['link'];               
            $user = auth()->user();
            $shortened_link="";    
            $today = Carbon::now()->addHours(7);  
            $link_lifespan = config("setting.EXPIRED_SHORT_LINK_DEFAULT",3);       
            $checkCustom = false;
            if(isset($user) && $user->isVerify())
            {   
                $short_url["user_id"] = $user->id;        
                $short_url["vefify"]=true; 
                $link_lifespan = $user->premium->link_lifespan;
                if(($count_custom_links_remaining_in_cycle = $user->getCountCustomLinksRemainingInCycle()) < 1)
                {                    
                    // $short_url["shortened_link"] = ShortLinkService::randomShortenedLink($shortUrlRepo);
                    $short_url["expired"] =  $today->addDays($link_lifespan);
                }
                else
                {
                    if($user->checkFeature("Custom shortened link"))
                        if(isset($data["back_half"]))
                        {   
                            $checkCustom = true;                 
                            $shortUrl = $shortUrlRepo->findBy("shortened_link",trim($data["back_half"]))->first();
                            if(isset($shortUrl))
                                return ResponseJson::failed("Custom back half already exists",422);
                            else
                                $shortened_link = trim($data["back_half"]);                                                   
                        }                                                
                    if(isset($data["make_an_appointment"]) && isset($data["effective_time"]) && $user->checkFeature("Set effective time"))
                    {
                        $checkCustom = true;
                        $effective_time = Carbon::parse($data["effective_time"])->addHours(7);
                        $short_url["effective_time"] = Carbon::parse($data["effective_time"])->addHours(7);
                    }
                    else
                        $effective_time = $today;   
                    if(isset($data["expired"]) && $user->checkFeature("Set expired"))
                    {
                        $checkCustom = true;
                        $expired = Carbon::parse($data["expired"])->addHours(7);
                        if($effective_time->gte($expired))
                            return ResponseJson::failed(isset($data["effective_time"]) ? "Invalid start time" : "Invalid end time",422);                    
                        else
                        {                             
                            if($effective_time->addDays($link_lifespan)->lte($expired))
                                return ResponseJson::failed("Registration time exceeds regulations",422);
                        }
                    }
                    else
                        $expired = $effective_time->addDays($link_lifespan);
                    $short_url["expired"] =  $expired;                  
                    if(isset($data["limit_visits"]) && $user->checkFeature("Set limit visits"))
                    {                    
                        $checkCustom = true;
                        if(is_numeric($data["limit_visits"]))                                                 
                            $short_url["limit_visits"] = $data["limit_visits"];                        
                        else
                            return ResponseJson::failed("Limit visits must be an integer",422);
                    }        
                }                              
            }
            else
            {          
                $short_url["vefify"]=false;                      
                $short_url["expired"] = $today->addDays($link_lifespan);
            }
            if($shortened_link == "")
                $shortened_link = ShortLinkService::randomShortenedLink($shortUrlRepo);
            $short_url["shortened_link"] = $shortened_link;    
            $short_url["flag_custom"] = $checkCustom;  
            if($checkCustom)
                $count_custom_links_remaining_in_cycle--;
            $short_url["count_custom_links_remaining_in_cycle"] = $count_custom_links_remaining_in_cycle;
            if(isset($data["title"]) && trim($data["title"]) !="")
                $short_url["title"] = trim($data["title"]);                                                  
            $shortUrlRepo->create($short_url);
            return ResponseJson::success(data:$short_url);
        }
        return ResponseJson::failed("This is not a valid url",422);
    }
    public static function randomShortenedLink($shortUrlRepo)
    {
        $shortened_link = null;
        do{
            $shortened_link = Str::random(10);
        }while($shortUrlRepo->findBy("shortened_link",$shortened_link)->first()!=null);   
        return $shortened_link;
    }
    public static function update($shortUrlRepo,$id,$data,bool $admin = false)
    {        
        $shortLink = $shortUrlRepo->find($id);
        if(!isset($shortLink))
            return ResponseJson::failed("Short link does not exist");        
        $user = auth()->user();
        if($admin == false)        
        {            
            if($shortLink->user_id != $user->id)
                return ResponseJson::failed("You do not have permission to edit this short link",401);        
        }
        $shortLink->title = $data["update_title"];          
        $today = Carbon::now()->addHours(7); 
        if($user->checkFeature("Custom shortened link"))
        {
            if(isset($data["update_back_half"]))
            {                                
                $shortUrl = $shortUrlRepo->findBy("shortened_link",trim($data["update_back_half"]))->first();
                if(isset($shortUrl) && $shortLink->id != $shortUrl->id)
                    return ResponseJson::failed("New custom back half already exists",422);
                else
                    $shortLink->shortened_link = trim($data["update_back_half"]);                                                   
            }     
            else
                return ResponseJson::failed("Back half cannot be empty",422);
        }        
        if(isset($data["make_an_appointment"]) && isset($data["update_effective_time"]) && $user->checkFeature("Set effective time"))
        {
            $effective_time = Carbon::parse($data["update_effective_time"])->addHours(7);
            $shortLink->effective_time = Carbon::parse($data["update_effective_time"])->addHours(7);
        }
        else
            $effective_time = $today;   
        if($user->checkFeature("Update expired"))
        {
            if(isset($data["update_expired"]))
            {
                $expired = Carbon::parse($data["update_expired"])->addHours(7);
                if($effective_time->gte($expired))
                    return ResponseJson::failed(isset($data["effective_time"]) ? "Invalid start time" : "Invalid end time",422);                    
                else
                {                             
                    if($effective_time->addDays(ShortLinkService::getMaximumTermExpired())->lte($expired))
                        return ResponseJson::failed("Registration time exceeds regulations",422);
                }
            }
            else
                $expired = $effective_time->addDays(ShortLinkService::getMaximumTermExpired());
            $shortLink->expired = $expired;   
        }           
        if($user->checkFeature("Set limit visits"))
        {
            if(isset($data["update_limit_visits"]))
            {
                if(is_numeric($data["update_limit_visits"]))
                    $shortLink->limit_visits = $data["update_limit_visits"];
                else
                    return ResponseJson::failed("Limit visits must be an integer",422);
            }
            else
                $shortLink->limit_visits = null;
        }   
        if($user->checkFeature("Set password"))
        {
            if(isset($data["check_box_set_password"]))
            {
                if(!isset($data["update_password"]) || trim($data["update_password"])=="")
                    return ResponseJson::failed("If the password feature is enabled, it cannot be left blank",422);            
                $shortLink->password = $data["update_password"];
            }        
            else
                $shortLink->password = null;
        }                                         
        $shortLink->save();
        return ResponseJson::success(data:$shortLink); 
    }
    public static function getOriginalLink($shortUrlRepo,string $shortened_link,?string $password)
    {
        $short_url = $shortUrlRepo->findBy("shortened_link",$shortened_link)->first();
        if(isset($short_url))
        {      
            if($short_url->effective_time > Carbon::now()->addHours(7)) 
                return -1;     
            if($short_url->expired >= Carbon::now()->addHours(7))
            {
                if($short_url->limit_visits != null && $short_url->total_visits == $short_url->limit_visits)
                    return -6;  
                if(isset($short_url->password))
                {
                    
                    // dd($short_url->password);  
                    if(!isset($password) )
                    {
                        $method = request()->method();
                        if( $method == "GET")
                            return -2;
                        return -3;
                    }                                     
                    if( $short_url->password != $password)
                        return -3;
                }                               
                $short_url->total_visits+=1;
                $short_url->save();
                $original_link = $short_url->original_link;
                if(!str_starts_with($original_link, 'https://') && !str_starts_with($original_link, 'http://')) 
                    $original_link = 'https://' . $original_link;
                return $original_link;
            }              
            return -4;//hết hạn                        
        }
        return -5; //không tồn tại
    }

    public static function get($shortUrlRepo,?int $status = 0,$perpage)
    {
        $data = $shortUrlRepo->getPaginate($status,$perpage);
        return ResponseJson::success(data:$data);
    }
    public static function findByUserId($shortUrlRepo,$user_id, ?int $status = 0,$perpage)
    {                       
        $query = $shortUrlRepo->where("user_id","=",$user_id);
        switch ($status) {
            case 1:
                $query = $query->where(function ($query) {
                    $query->whereNull('effective_time')
                        ->whereDate('expired', '>=', now())
                        ->orWhere(function ($subquery) {
                            $subquery->whereDate('effective_time', '<=', now())
                                ->whereDate('expired', '>=', now());
                        });
                });
                break;
            case 2:
                $query = $query->whereDate('effective_time', '>', now());
                break;
            case 3:
                $query = $query->whereColumn('limit_visits', '=', 'total_visits');
                break;
            case 4:
                $query = $query->whereDate('expired', '<', now());
                break;        
            case 5:
                $query = $query->whereNotNull("password");
                break;    
            default:
                ResponseJson::success(data:$shortUrlRepo->findByPaginate("user_id",$user_id,$perpage));
                break;
        }        
        return ResponseJson::success(data:$query->paginate($perpage ?? config("setting.PER_PAGE",10)));
    }
    public static function deleteWhere($shortUrlRepo,int $id, bool $admin = false)
    {
        $user = auth()->user();
        if($admin)
        {
            if($shortUrlRepo->delete($id)>0)
                return ResponseJson::success();
            return ResponseJson::failed("Not deleted yet");
        }
        if($shortUrlRepo->deleteWhere($id,$user->id)>0)
            return ResponseJson::success();
        return ResponseJson::failed("The link does not exist or you do not have access");
    }
}





