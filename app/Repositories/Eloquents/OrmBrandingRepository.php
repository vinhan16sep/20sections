<?php

namespace App\Repositories\Eloquents;

use App\Branding;

class OrmBrandingRepository
{
    public static function fetchAllWithPagination($limit = 10, $seachCriteria = []){
        $name = $seachCriteria['name'];
        $categoryId = $seachCriteria['category_id'];
        return Branding::with('category')->whereExists(function($query) use ($name, $categoryId){
            $query->where('is_deleted' , 0);
            if($name != ''){
                $query->where('name', 'like', '%' . $name . '%');
            };
            if($categoryId != ''){
                $query->where('category_id', $categoryId);
            };
        })->paginate($limit);
    }

    public function update($id, $data = []){
        Branding::where('id', $id)->update($data);
        return true;
    }

    public function fetchWithTableById($id){
        return Branding::with('category')->where(['is_deleted'=> 0, 'id' => $id])->first();
    }

    public function fetchById($id){
        return Branding::findOrFail($id);
    }
}