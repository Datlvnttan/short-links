<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Repositories\Interface\FeatureRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Services\FeatureService;
use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password',    
        'token',
        'role_id',
        'premium_id',
        'premium_register_date',
        'status',
        'paymented',
        'amount_of_money',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'paymented'=> 'boolean',
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
        ];
    }    
    public function isVerify()
    {
        return $this->status;
    }
    public function premium()
    {
        return $this->belongsTo(Premium::class,"premium_id");
    }
    public function role()
    {
        return $this->belongsTo(Role::class,"role_id");
    }
    public function getRole()
    {
        return $this->role->role_name;
    }
    public function isManager()
    {
        return $this->role->role_manager;
    }
    // private $routeInterfaces;
    public function getRouteInterfaces()
    {                       
        return User::select("routes.route_name","routes.interface_name","routes.icon")->distinct()
            ->join("permission","users.role_id","=","permission.role_id")
            ->join("route_list_groups","route_list_groups.group_route_id","=","permission.group_route_id")
            ->join("routes","routes.id","=","route_list_groups.route_id")
            ->where("users.id",$this->id)
            ->whereNotNull("routes.interface_name")->get();           
        // return $this->routeInterfaces;
    }

    protected $featureService;
    public function buildFeatureService(PremiumRepositoryInterface $premiumRepo)
    {
        $this->featureService = new FeatureService(null,$premiumRepo);
    }   
    private $featuresReality;
    private $featuresByPackage;
    private $mostRecentCycleDate;

    public function getMostRecentCycleDate()
    {
        if($this->mostRecentCycleDate == null)
        {            
            $premium = $this->premium;           
            $diff = Carbon::parse($this->premium_register_date)->diff(Carbon::now());
            $countDaysPassed = $diff->days % $premium->billing_cycle;
            $this->mostRecentCycleDate = Carbon::now()->addDays(-$countDaysPassed);
        }     
        return $this->mostRecentCycleDate;  
    }
    private function buildQueryGetCountLinksInCycle()
    {
        return ShortUrl::where("user_id", $this->id)
            ->where("created_at",">=",$this->getMostRecentCycleDate());
    }
    private $countLinksGeneratorInCurrentCycle;
    public function getCountLinksGeneratorInCurrentCycle()
    {
        if($this->countLinksGeneratorInCurrentCycle == null)
            $this->countLinksGeneratorInCurrentCycle = $this->buildQueryGetCountLinksInCycle()
                        ->count();
        return $this->countLinksGeneratorInCurrentCycle;
    }
    // public function getCountLinksRemainingInCycle()
    // {
    //     return $this->premium-> - $this->getCountCreateQRCodeGeneratorInCurrentCycle();        
    // }
    private $countCustomLinksGeneratorInCurrentCycle;
    public function getCountCustomLinksGeneratorInCurrentCycle()
    {
        if($this->countCustomLinksGeneratorInCurrentCycle == null)
            $this->countCustomLinksGeneratorInCurrentCycle = $this->buildQueryGetCountLinksInCycle()
                        ->where("flag_custom",true)->count();
        return $this->countCustomLinksGeneratorInCurrentCycle;
    }
    public function getCountCustomLinksRemainingInCycle()
    {
        return $this->premium->limit_create_custom_link - $this->getCountCustomLinksGeneratorInCurrentCycle();        
    }
    // private $countQRCodeRemainingCycle;
    public function getCountCreateQRCodeRemainingInCycle()
    {
        return $this->premium->limit_create_qrcode - $this->getCountCreateQRCodeGeneratorInCurrentCycle();        
    }
    

    private $countCreateQRCodeGeneratorInCurrentCycle;
    public function getCountCreateQRCodeGeneratorInCurrentCycle()
    {        
        if($this->countCreateQRCodeGeneratorInCurrentCycle == null)
            $this->countCreateQRCodeGeneratorInCurrentCycle = $this->buildQueryGetCountLinksInCycle()
                        ->whereNotNull("path_qrcode")->count();
        return $this->countCreateQRCodeGeneratorInCurrentCycle;
    }
    private function buildQueryGetFeatures($key,$value)
    {
        return Premium::select('features.id as feature_id', 'feature_name', 'feature_title')
                    ->join('premium_features', function ($join) use($key,$value){
                        $join->on('premiums.id', '=', 'premium_features.premium_id')
                            ->where(function ($query) use($key,$value){
                                $query->where('premiums.'.$key, $value)
                                    ->orWhere('premiums.level', '<', $this->premium->level);
                            }); 
                        })->join('features', 'premium_features.feature_id', '=', 'features.id')
                        ->distinct()        
                        ->get();  
    }

    public function checkFeature($featureName,?bool $byPackage = false)
    {
        if($this->isManager())
            return true;
        $features = $this->getFeatures($byPackage);
        if( $features == null || count($features) == 0)
            return false;
        return $features->contains("feature_name",$featureName);
    }
    public function getFeatures(?bool $byPackage = false)
    {                 
        if($this->featuresReality == null || $this->featuresByPackage == null)
        {                                
            $key = "id";
            $value = $this->premium->id;
            $this->featuresByPackage = $this->buildQueryGetFeatures($key,$value);
            if(!$this->paymented)
            {
                if($this->getCountCustomLinksRemainingInCycle()>0)
                {
                    $key = "upgrade_costs";
                    $value = 0;
                    $this->featuresReality = $this->buildQueryGetFeatures($key,$value);                                    
                }
                else                
                    $this->featuresReality = [];                                        
            }   
            else 
                $this->featuresReality = $this->getCountCustomLinksRemainingInCycle() > 0 ? $this->featuresByPackage : [];                
        }        
        // dd($this->featuresByPackage->contains("feature_name","Set expired"));
        return $byPackage ? $this->featuresByPackage : $this->featuresReality;                          
    }    
}
