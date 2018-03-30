<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3/27/2018
 * Time: 1:55 PM
 */

namespace App\Repositories\Eloquents;
use App\Product;

class OrmProductRepository
{

    private $product;

    function __construct(){
        $this->product = new Product;
    }

    public function fetchAllWithPagination($limit = 10, $seachCriteria = []){
        $name = $seachCriteria['name'];
        $categoryId = $seachCriteria['category_id'];
        $brandingId = $seachCriteria['branding_id'];
        return $product = $this->product::with('category', 'branding')->whereExists(function($query) use ($name, $categoryId, $brandingId){
            $query->where('is_deleted' , 0);
            if($name != ''){
                $query->where('name', 'like', '%'.$name.'%');
            };
            if($categoryId != ''){
                $query->where('category_id', $categoryId);
            };
            if($brandingId != ''){
                $query->where('branding_id', $brandingId);
            };

        })->paginate($limit);
    }

    public function insert($data){
        $this->product::create($data);
        return true;
    }

    public function fetchByIdWithRelationData($id){
        return $this->product::with('category', 'branding')->where(['is_deleted' => 0, 'id' => $id])->first();
    }
    public function fetchById($id){
        return $this->product::findOrFail($id);
    }

    public function update($id, $data){
        $this->product::where('id', $id)
            ->update($data);
        return true;
    }

    public function fetchActive($active){
        return $this->product::where(['is_deleted' => 0, 'is_activated' => $active])->count();
    }

    public function fetchQuantity(){
        $inStock = $this->product::where([['is_deleted', 0], ['quantity', '!=', 0]])->count();
        $outStock = $this->product::where([['is_deleted', 0], ['quantity', '=', 0]])->count();

        return [
            'inStock' => $inStock,
            'outStock' => $outStock
        ];
    }

    public function fetchAllWithBrandId($limit = 10, $seachCriteria = [], $brandId){
        $name = $seachCriteria['name'];
        $categoryId = $seachCriteria['category_id'];
        $brandingId = $seachCriteria['branding_id'];
        return $product = $this->product::with('category', 'branding')->whereExists(function($query) use ($name, $categoryId, $brandingId, $brandId){
            $query->where([['is_deleted' , 0],['brand_id', $brandId]]);
            if($name != ''){
                $query->where('name', 'like', '%'.$name.'%');
            };
            if($categoryId != ''){
                $query->where('category_id', $categoryId);
            };
            if($brandingId != ''){
                $query->where('branding_id', $brandingId);
            };

        })->paginate($limit);
    }
}