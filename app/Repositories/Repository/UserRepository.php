<?php
namespace App\Repositories\Repository;

use App\Helpers\SortHelper;
use App\Models\User;
use App\Repositories\EloquentRepository;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getSortPaginated(mixed $perPage, ?int $sortUName, ?int $sortBDay,  ?int $sortCreatedAt, mixed $columns = ['*'])
    {
        $perPage = $perPage ?? intval(config("app.PER_PAGE"),10);       
        $query = $this->model::select($columns);
        if(isset($sortUName))
            $query = $query->orderBy("username",SortHelper::parse($sortUName));
        if(isset($sortBDay))
            $query = $query->orderBy("date_of_birth",SortHelper::parse($sortBDay));
        if(isset($sortCreatedAt))
            $query = $query->orderBy("created_at",SortHelper::parse($sortCreatedAt));        
        return $query->paginate($perPage);
    }
    public function findByField($field_value)
    {
        return $this->model::where($this->getField($field_value),$field_value)->first();     
    }
    public function getField($field_value)
    {
        return filter_var($field_value, FILTER_VALIDATE_EMAIL) ? "email" : ((ctype_digit($field_value) && strlen($field_value) == 10) ? "phone_number" : "username");
    }
    public function getPaginated(?int $perPage, mixed $columns = ['*'])
    {
        $perPage = $perPage ?? intval(config("app.PER_PAGE"),10);        
        return $this->model::select("users.*","role_name","premium_name")
                            ->join("roles","roles.id","=","role_id")
                            ->join("premiums","premiums.id","=","premium_id")
                            ->paginate($perPage);
    }
    public function checkPassword($id,$password)
    {
        $user = $this->model::find($id);
        if(isset($user))
            if(Hash::check($password, $user->password))
                return true;
        return false;
    }

    public function esdsd($id,$password)
    {
        //Tất cả user dùng DB
        $users = DB::table('users')->all();
         //Tất cả user dùng model
        $users = User::all();


        //Lấy 1 user theo id
        $users = DB::table('users')->find("id");
         //Lấy 1 user theo thược tính bất kỳ 



        $query = "SELECT * FROM your_table WHERE column_name = ?"; // Điền câu truy vấn SQL của bạn vào đây
        $bindings = ['some_value']; // Truyền giá trị tham số vào truy vấn
        $results = DB::select($query, $bindings);

        $query = "SELECT * FROM your_table WHERE column_name = ?"; // Điền câu truy vấn SQL của bạn vào đây
        $bindings = ['some_value']; // Truyền giá trị tham số vào truy vấn
        $results = DB::select($query);
    }
}
