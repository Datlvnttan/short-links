<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use App\Repositories\Interface\ShortUrlRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeService
{    
    protected $shortUrlRepo;
    public function __construct(ShortUrlRepositoryInterface $shortUrlRepo)
    {
        $this->shortUrlRepo = $shortUrlRepo;
    }    
    public function GetQRCode(string $shortened_link)
    {
        $user = auth()->user();
        if(isset($user->id) && $user->isVerify())
        {
            $short_link = $this->shortUrlRepo->findBy("shortened_link", $shortened_link)->first();
            if (isset($short_link))
            {
                
                if($short_link->user_id == $user->id)
                {
                    $path = "storage/$user->id";
                    $publicPath = public_path($path);
                    if(!File::exists($path))
                        File::makeDirectory($publicPath,0777,true,true);
                    else if(File::exists("$path/$shortened_link.svg"))
                        return ResponseJson::success(data: url("$path/$shortened_link.svg"));
                    if($user->getCountCreateQRCodeRemainingInCycle()>0)
                    {                                    
                        $qrcode = QrCode::format("svg")->size(200)->generate(URL::to($shortened_link), "$publicPath/$shortened_link.svg");
                        $this->shortUrlRepo->update($short_link->id,[
                            "path_qrcode"=>"$path/$shortened_link.svg"
                        ]);
                        //ImageOptimizer::optimize("$publicPath/$shortened_link.eps","$publicPath/$shortened_link.jpg");
                        return ResponseJson::success(data:[
                            "url"=>url("$path/$shortened_link.svg"),
                            "create_remaining" => $user->getCountCreateQRCodeRemainingInCycle()-1,
                        ]);
                    } 
                    return ResponseJson::error('You have used up all uses create QR Code for this cycle'); 
                }   
                return ResponseJson::error('Unauthorized', 401);
                                      
            }
            return ResponseJson::error("The short link does not exist");
        }        
        return ResponseJson::error('Unauthorized', 401);
    }
    public function create()
    {

    }
}

