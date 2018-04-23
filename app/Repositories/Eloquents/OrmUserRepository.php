<?php

namespace App\Repositories\Eloquents;
use App\User;

class OrmUserRepository
{
    function __construct(){
    }

    public function countEmail($inputEmail){
        return User::where(['email' => $inputEmail])->get()->count();
    }

    public function insert($data){
        return User::create($data);
    }

    public function fetchAllWithPagination($limit = 10, $searchCriteria, $dateFrom, $dateTo, $role){
        $name = $searchCriteria['name'];
        $dateRange = $searchCriteria['dateRange'];
        return User::whereExists(function ($query) use ($name, $dateRange, $dateFrom, $dateTo, $role){
            $query->where('role', $role);
            if ($dateRange != ''){
                $query->where([
                    ['created_at', '>=', $dateFrom],
                    ['created_at', '<=', $dateTo]
                ]);
            }
            if ($name != ''){
                $query->where('name', 'like', '%'.$name.'%')->orWhere('email', 'like', '%'.$name.'%');
            }
        })->paginate($limit);
    }

    public function fetchById($id){
        return User::findOrFail($id);
    }
}
