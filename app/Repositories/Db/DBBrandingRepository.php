<?php

namespace App\Repositories\Db;

use Illuminate\Support\Facades\DB;

class DbBrandingRepository
{
    public function insert($data = []){
        DB::table('branding')->insert($data);
        return true;
    }

    public function update($id){
        $result = DB::table('branding')
            ->where('id', $id)
            ->update(['is_deleted' => 1]);
        return $result;
    }

    public function active($id, $active = 1){
        $result = DB::table('branding')
            ->where('id', $id)
            ->update(['is_activated' => $active]);
        return $result;
    }

    public function fetchByCategoryId($categoryId){
        return DB::table('branding')->where(['is_deleted' => 0, 'category_id' => $categoryId])->get();
    }
}