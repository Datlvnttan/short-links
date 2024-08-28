<?php
namespace App\Services;

use App\Helpers\ResponseJson;
use App\Models\Premium;
use App\Models\User;
use App\Repositories\Interface\PremiumFeatureRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;

class  PremiumService
{    
    protected $premiumRepo, $premiumFeatureRepo;
    protected $featureService;
    public function __construct(PremiumRepositoryInterface $premiumRepo, PremiumFeatureRepositoryInterface $premiumFeatureRepo)
    {
        $this->premiumRepo = $premiumRepo;
        $this->premiumFeatureRepo = $premiumFeatureRepo;
        $this->featureService = new FeatureService(null, $premiumRepo);
    }    
    public function get()
    {
        // $data = $this->premiumRepo->leftJoin("premium_features","premium_features.premium_id","=","premiums.id")
        //                         ->leftJoin("features","features.id","=","premium_features.feature_id")
        //                         ->select(
        //                             "premiums.*",
        //                             "features.feature_name",
        //                             "features.feature_title",                                   
        //                         )->get();
        $data = $this->premiumRepo->all();
        return ResponseJson::success(data: $data);
    }   
    public function getLevel()
    {
        $data = $this->premiumRepo->getLevel();
        return ResponseJson::success(data: $data);
    } 
    public function create($data)
    {          
        $premium = $this->premiumRepo->findBy("premium_name",trim($data["premium_name"]))->first();
        if(isset($premium))
            return ResponseJson::errors([
                "premium_name"=>["This premium package name already exists"]
            ],422);                
        if(($premium = $this->premiumRepo->create($data))!=null)
        {           
            if(isset($data["feature_add"])) 
                foreach($data["feature_add"] as $feature_id)
                {
                    $this->premiumFeatureRepo->create([
                        "feature_id"=> $feature_id,
                        "premium_id"=>$premium->id
                    ]);
                }
            return ResponseJson::success(data: $premium);
        }
        return ResponseJson::failed("Create failed",422);
    }
    public function show(int $id)
    {
        $data = $this->premiumRepo->find($id);
        if(isset($data))
            return ResponseJson::success(data:$data);
        return ResponseJson::failed("Premium does not exist");
    }
    public function update(int $id , array $data)
    {
        $premium = $this->premiumRepo->find($id);
        if(isset($premium))
        {
            $premium->premium_name = $data["premium_name"];
            $premium->premium_title = $data["premium_title"];
            $premium->level = $data["level"];
            $premium->premium_icon = $data["premium_icon"] ?? null;
            $premium->billing_cycle = $data["billing_cycle"];
            $premium->upgrade_costs = $data["upgrade_costs"];
            $premium->limit_create_custom_link	 = $data["limit_create_custom_link"];
            $premium->limit_create_qrcode = $data["limit_create_qrcode"];
            $premium->link_lifespan = $data["link_lifespan"];
            $premium->save();
            $premiumFeatures = $this->premiumFeatureRepo->findBy("premium_id",$id);
            if(isset($data["feature_add"]))
                foreach($data["feature_add"] as $feature_id)
                {
                    if(!$premiumFeatures->contains("feature_id",$feature_id))                
                    {
                        $this->premiumFeatureRepo->create([
                            "feature_id"=> $feature_id,
                            "premium_id"=>$premium->id
                        ]);
                    }
                }    
            else
                $data["feature_add"] = [];
            $this->premiumFeatureRepo->where('premium_id', "=",$id)
                ->whereNotIn('feature_id', $data["feature_add"])
                ->delete();        
            return ResponseJson::success(data: $premium);
        }        
        return ResponseJson::failed("Premium does not exist");
        
    }   
    public function destroy(int $id, string $password)
    {
        $user = auth()->user();
        if(password_verify($password, $user->password))
        {
            $premium = $this->premiumRepo->find($id);
            if(isset($premium))
            {
                $data = $this->premiumFeatureRepo->findBy('premium_id', $premium->$id);
                if(isset($data) && count($data) > 0)
                    return ResponseJson::failed("Please all features of this paid plan can be removed");
                $users = User::where("premium_id", $premium->id)->get();
                if(isset($users)&& count($users) > 0)
                    return ResponseJson::failed("There is an existing user of this package");
                $premium->delete();
                return ResponseJson::success("Deleted successfully");
            }
            return ResponseJson::failed("Premium does not exist");
        }       
        return ResponseJson::failed("Incorrect password",402);;
    }
}

