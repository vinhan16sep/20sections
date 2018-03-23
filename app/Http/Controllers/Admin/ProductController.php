<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Product;
use File;
use DateTime;
use Storage;
use Crypt;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('category')->get();
        $keyword = Input::get('search');
        $category_id = Input::get('category_id');
        $branding_id = Input::get('branding_id');

        $product = Product::with('category', 'branding')->whereExists(function($query) use ($keyword, $category_id, $branding_id){
            $query->where('is_deleted' , 0);
            if($keyword != ''){
                $query->where('name', 'like', '%'.$keyword.'%');
            };
            if($category_id != ''){
                $query->where('category_id', $category_id);
            };
            if($branding_id != ''){
                $query->where('branding_id', $branding_id);
            };
            
        })->paginate(10);
        $product->setPath('product?search='.$keyword.'&category_id='.$category_id.'&branding_id='.$branding_id);
        return view('admin.product.index', [
                        'category' => $category,
                        'product' => $product,
                        'keyword' => $keyword,
                        'category_id' => $category_id,
                        'branding_id' => $branding_id,
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = DB::table('category')->get();
        return view('admin.product.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $path = base_path() . '/' . 'storage/app/products';
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('product', $request->id, $slug);
        $newFolderPath = $this->buildNewFolderPath($path, $uniqueSlug);
        $files = $request->file('image');
        foreach ($files as $key => $file) {
            $fileName[$key] = $file->hashName();
            $file->store('products/' . $newFolderPath[0]);
        }
        
            
        File::makeDirectory($newFolderPath[1], 0777, true, true);
        $image_json = json_encode($fileName);
        $keys = ['name','branding_id', 'category_id', 'quantity', 'price', 'time', 'production', 'madein', 'madeof', 'weight', 'volume', 'description', 'content', ];
        $input = $this->createQueryInput($keys, $request);
        $input['image'] = $image_json;
        $input['slug'] = $uniqueSlug;
        $input['created_at'] = new DateTime();

        Product::create($input);

        return redirect()->intended('20s-admin/product');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category', 'branding')->where(['is_deleted' => 0, 'id' => $id])->first();
        return view('admin.product.detail', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('category')->get();
        $product = Product::with('category', 'branding')->where(['is_deleted' => 0, 'id' => $id])->first();
        return view('admin.product.edit', ['category' => $category, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $product = Product::findOrFail($id);

        $path = base_path() . '/storage/app/products/';
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('product', $product->id, $slug);
        if($slug != $product->slug){
            rename($path . '/' . $product->slug, $path . '/' . $uniqueSlug);
        }
        // $input = $request->all();
        
        // $newFolderPath = $this->buildNewFolderPath($path, $file);

        $keys = ['name','branding_id', 'category_id', 'quantity', 'price', 'time', 'production', 'madein', 'madeof', 'weight', 'volume', 'description', 'content', ];
        $input = $this->createQueryInput($keys, $request);
        $input['slug'] = $uniqueSlug;


        $fileName = [];
        $fileName = json_decode($product->image);

        // Upload image
        if($request->file('image')){
            foreach ($request->file('image') as $key => $file) {
                $fileName[] = $file->hashName();
                $file->store('products/' . $uniqueSlug);
            }
            $image_json = json_encode($fileName);
            $input['image'] = $image_json;
        }
        $input['updated_at'] =new DateTime();
        Product::where('id', $id)
            ->update($input);
        return redirect()->intended('20s-admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function selectBranding(Request $request)
    {
        $category_id = $request->category_id;
        $branding = DB::table('branding')->where(['is_deleted' => 0, 'category_id' => $category_id])->get();
        $success = false;
        if($branding->toArray() != null){
            $success = true;
        }
        return response()->json(['success' => $success, 'branding' => $branding, 'status' => '200']); 
    }

    public function removeImage(Request $request)
    {
        $image = $request->image;
        $id = $request->product_id;
        $path = base_path() . '/storage/app/products/';
        $product = Product::findOrFail($id);


        $upload = [];
        $upload = json_decode($product->image);
        $key = array_search($image, $upload);
        unset($upload[$key]);
        $newUpload = [];
        foreach ($upload as $key => $value) {
            $newUpload[] = $value;
        }
        
        $image_json = json_encode($newUpload);
        $success = false;
        $result = DB::table('product')
            ->where('id', $id)
            ->update(['image' => $image_json]);
        if($result){
            File::delete($path.$product->slug.'/'.$image);
            $success = true;
        }
        return response()->json(['success' => $success, 'status' => '200']);
    }

    public function remove(Request $request)
    {
        $id = $request->id;
        $path = base_path() . '/storage/app/products/';
        $product = Product::findOrFail($id);
        $success = false;
        if($product){
            $result = DB::table('product')
            ->where('id', $id)
            ->update(['is_deleted' => 1]);
            if($result){
                File::deleteDirectory($path.$product->slug);
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']); 
    }

    public function active(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $success = false;
        if($product){
            if($product->is_activated == 0){
                $result = DB::table('product')
                ->where('id', $id)
                ->update(['is_activated' => 1]);
            }else{
                $result = DB::table('product')
                ->where('id', $id)
                ->update(['is_activated' => 0]);
            }
            if($result){
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']);
    }

    protected function validateRequest($request){
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'branding_id' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required',
            'description' => 'required',
            'content' => 'required',
            'production' => 'required',
        ],[
            'name.required' => 'Tiêu đề không được trống',
            'category_id.required' => 'Danh mục không được trống',
            'branding_id.required' => 'Thương hiệu không được trống',
            'quantity.required' => 'Số lượng không được trống',
            'price.required' => 'Giá không được trống',
            'description.required' => 'Giới thiệu không được trống',
            'content.required' => 'Nội dung không được trống',
            'production.required' => 'Nhà sản xuất không được trống',
            'quantity.numeric' => 'Số lượng phải là số',
        ]);
    }
}
