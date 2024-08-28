<?php
namespace App\Repositories\Repository;

use App\Repositories\EloquentRepository;
use App\Repositories\Interface\ShortUrlRepositoryInterface;

class ShortUrlRepository extends EloquentRepository implements ShortUrlRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ShortUrl::class;
    }
    public function deleteWhere(int $id, int $userId)
    {
        return $this->model::where("id",$id)
                    ->where("user_id",$userId)
                    ->delete();
    }
    public function findByPaginate($field, $value, ?int $perpage)
    {
        $perpage = $perpage ?? config('setting.PER_PAGE',10);
        return $this->model::where($field, $value)->paginate($perpage);
    }
    public function getPaginate($status,?int $perpage)
    {
                
        switch ($status) {
            case 1:
                $query = $this->model::where(function ($query) {
                    $query->whereNull('effective_time')
                        ->whereDate('expired', '>=', now())
                        ->orWhere(function ($subquery) {
                            $subquery->whereDate('effective_time', '<=', now())
                                ->whereDate('expired', '>=', now());
                        });
                });
                break;
            case 2:
                $query = $this->model::whereDate('effective_time', '>', now());
                break;
            case 3:
                $query = $this->model::whereColumn('limit_visits', '=', 'total_visits');
                break;
            case 4:
                $query = $this->model::whereDate('expired', '<', now());
                break; 
            case 5:
                $query = $this->model::whereNull("user_id");
                break;            
            default:
                return $this->model::paginate($perpage ?? config("setting.PER_PAGE",10));                
        }        
        return $query->paginate($perpage ?? config("setting.PER_PAGE",10));
    }
}
