<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3/29/2018
 * Time: 11:21 AM
 */

namespace App\Repositories\Eloquents;
use App\User;

class OrmUserRepository
{
    private $user;

    function __construct(){
        $this->user = new User;
    }

    public function insert($data){
        return $this->user::create($data);
    }

    public function fetchAllWithPagination($limit = 10, $searchCriteria, $dateFrom, $dateTo, $role){
        $name = $searchCriteria['name'];
        $dateRange = $searchCriteria['dateRange'];
        return $this->user::whereExists(function ($query) use ($name, $dateRange, $dateFrom, $dateTo, $role){
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
        return $this->user::findOrFail($id);
    }
}
