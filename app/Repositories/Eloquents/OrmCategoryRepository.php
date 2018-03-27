<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3/27/2018
 * Time: 10:35 AM
 */

namespace App\Repositories\Eloquents;

use App\Category;

class OrmCategoryRepository
{
    public function fetchAll(){
        return Category::where('is_deleted', 0)->get();
    }

    public function fetchAllWithPagination($keyword, $limit = 10){
        return Category::whereExists(function ($query) use ($keyword){
            $query->where('is_deleted', 0);
            if($keyword != ''){
                $query->where('name', 'like', '%'.$keyword.'%');
            }
        })->paginate($limit);
    }

    public function fetchById($id){
        return Category::findOrFail($id);
    }
}