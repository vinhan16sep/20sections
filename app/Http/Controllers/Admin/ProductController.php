<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
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

use App\Repositories\Eloquents\OrmProductRepository;
use App\Repositories\Db\DBProductRepository;

use App\Repositories\Eloquents\OrmCategoryRepository;

use App\Repositories\Db\DbBrandingRepository;

class ProductController extends Controller
{
    /**
     * @var OrmProductRepository
     */
    protected $ormProductRepository;
    /**
     * @var DBProductRespository
     */
    protected $dbProductRepository;
    /**
     * @var OrmCategoryRepository
     */
    protected $ormCategoryRepository;
    /**
     * @var DbBrandingRepository
     */
    protected $dbBrandingRepository;

    /**
     * ProductController constructor.
     * @param OrmProductRepository $ormProductRepository
     * @param DBProductRepository $dbProductRepository
     */
    public function __construct(
        OrmProductRepository $ormProductRepository,
        DBProductRepository $dbProductRepository,
        OrmCategoryRepository $ormCategoryRepository,
        DbBrandingRepository $dbBrandingRepository
        ){
        $this->middleware('auth:admin');
        $this->ormProductRepository = $ormProductRepository;
        $this->dbProductRepository = $dbProductRepository;
        $this->ormCategoryRepository = $ormCategoryRepository;
        $this->dbBrandingRepository = $dbBrandingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->ormCategoryRepository->fetchAll();
        $searchCriteria = [
            'name' => Input::get('search'),
            'category_id' => Input::get('category_id'),
            'branding_id' => Input::get('branding_id')
        ];
        // print_r($chart);die;
        $product = $this->ormProductRepository->fetchAllWithPagination(10, $searchCriteria);
        $product->setPath('product?search='.$searchCriteria['name'].'&category_id='.$searchCriteria['category_id'].'&branding_id='.$searchCriteria['branding_id']);
        return view('admin.product.index', [
                        'category' => $category,
                        'product' => $product,
                        'keyword' => $searchCriteria['name'],
                        'category_id' => $searchCriteria['category_id'],
                        'branding_id' => $searchCriteria['branding_id']
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->ormCategoryRepository->fetchAll();
        return view('admin.product.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

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

        $this->ormProductRepository->insert($input);

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
        $product = $this->ormProductRepository->fetchByIdWithRelationData($id);
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
        $category = $this->ormCategoryRepository->fetchAll();
        $product = $this->ormProductRepository->fetchByIdWithRelationData($id);
        return view('admin.product.edit', ['category' => $category, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $this->ormProductRepository->fetchById($id);

        $path = base_path() . '/storage/app/products/';
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('product', $product->id, $slug);
        if($slug != $product->slug){
            rename($path . '/' . $product->slug, $path . '/' . $uniqueSlug);
        }

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
        $this->ormProductRepository->update($id, $input);
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

    public function overView()
    {
        /**
         *
         * Product active and deactive
         *
         */
        $active = $this->ormProductRepository->fetchActive(0);
        $deactive = $this->ormProductRepository->fetchActive(1);
        $pieChart = [
                ['value' => $active, 'highlight' => '#00a65a', 'color' => '#00a65a', 'label' => 'Đang sử dụng'],
                ['value' => $deactive, 'highlight' => '#f56954', 'color' => '#f39c12', 'label' =>  'Không sử dụng']
                ];
        $pieChart = json_encode($pieChart);

        /**
         *
         * In stock and out of stock
         *
         */
        $quantity = $this->ormProductRepository->fetchQuantity();
        $inStock = $quantity['inStock'];
        $outOfStock = $quantity['outStock'];
        
        $quantityChart = [
                ['value' => $inStock, 'highlight' => '#00a65a', 'color' => '#00a65a', 'label' => 'Còn hàng'],
                ['value' => $outOfStock, 'highlight' => '#f56954', 'color' => '#f00', 'label' =>  'Hết hàng']
                ];
        $quantityChart = json_encode($quantityChart);

        /**
         *
         * Category
         *
         */
        // $category = DB::table('category')->where('is_deleted', 0)->get();
        // print_r($category);die;

        return view('admin.product.overView', ['pieChart' => $pieChart, 'quantityChart' => $quantityChart]);
    }

    public function selectBranding(Request $request)
    {
        $categoryId = $request->category_id;
        $branding = $this->dbBrandingRepository->fetchByCategoryId($categoryId);
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
        $product = $this->ormProductRepository->fetchById($id);


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
        $data = ['image' => $image_json];
        $result = $this->ormProductRepository->update($id, $data);
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
        $data = ['is_deleted' => 1];
        if($product){
            $result = $this->ormProductRepository->update($id, $data);
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
        $product = $this->ormProductRepository->fetchById($id);
        $success = false;
        if($product){
            if($product->is_activated == 0){
                $result = $this->ormProductRepository->update($id, ['is_activated' => 1]);
            }else{
                $result = $this->ormProductRepository->update($id, ['is_activated' => 0]);
            }
            if($result){
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']);
    }
}
