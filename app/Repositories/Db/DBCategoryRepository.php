<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3/27/2018
 * Time: 10:43 AM
 */
namespace App\Repositories\Db;

use Illuminate\Support\Facades\DB;

class DBCategoryRepository
{
    public function insert($data){
        DB::table('category')->insert($data);
        return true;
    }

    public function update($id, $data){
        DB::table('category')->where('id', $id)->update($data);
        return true;
    }
}