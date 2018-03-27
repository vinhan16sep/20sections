<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
use DateTime;

use App\Repositories\Eloquents\OrmCategoryRepository;
use App\Repositories\Db\DBCategoryRepository;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @var OrmCategoryRepository
     */
    protected $ormCategoryRepository;
    /**
     * @var DBCategoryRepository
     */
    protected $dbCategoryRepository;

    public function __construct(OrmCategoryRepository $ormCategoryRepository, DBCategoryRepository $dbCategoryRepository)
    {
        $this->middleware('auth:admin');

        $this->ormCategoryRepository = $ormCategoryRepository;
        $this->dbCategoryRepository = $dbCategoryRepository;
    }

    public function index()
    {
        $keyword = Input::get('search');
        $category = $this->ormCategoryRepository->fetchAllWithPagination($keyword);
        $category->setPath('category?search='.$keyword);
        return view('admin.category.index', ['category' => $category, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $path = base_path() . '/storage/app/category/';
        $input = $request->all();
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('category', $request->id, $slug);
        $file = null;
        $inputFile = Input::file('image');
        if($inputFile){
            $file = $inputFile->getClientOriginalName();
        }
        $newFolderPath = $this->buildNewFolderPath($path, $file);
        $data =  ['name' => $input['name'], 'slug' => $uniqueSlug, 'description' => $input['description']];
        // File::makeDirectory($newFolderPath[1], 0777, true, true);
        if($inputFile){
            $data['image'] = $newFolderPath[0];
        }
        $data['created_at'] =new DateTime();
        if($this->dbCategoryRepository->insert($data)){
            if($inputFile){
                $inputFile->move($path, $newFolderPath[0]);
            }
        }
        return redirect()->intended('20s-admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->ormCategoryRepository->fetchById($id);
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        $category = $this->ormCategoryRepository->fetchById($id);
        $path = base_path() . '/storage/app/category/';
        $input = $request->all();
        $file = null;
        $inputFile = Input::file('image');
        if($inputFile){
            $newFolderPath = $this->buildNewFolderPath($path, $inputFile->getClientOriginalName());
        }else{
            $newFolderPath = $this->buildNewFolderPath($path, $file);
        }
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('category', $request->id, $slug);

        $data = ['name' => $input['name'], 'slug' => $uniqueSlug, 'description' => $input['description']];
        $data['updated_at'] =new DateTime();
        if($inputFile){
            $data['image'] = $newFolderPath[0];
        }
        if($this->dbCategoryRepository->update($id, $data)){
            if($inputFile){
                File::delete($path.'/'.$category->image);
                $inputFile->move($path, $newFolderPath[0]);
            }
        }
        return redirect()->intended('20s-admin/category');
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

    public function remove(Request $request)
    {
        $id = $request->id;
        $category = $this->ormCategoryRepository->fetchById($id);
        $success = false;
        $data = ['is_deleted' => 1];
        if($category){
            $result = $this->dbCategoryRepository->update($id, $data);
            if($result){
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']); 
    }

    public function active(Request $request)
    {
        $id = $request->id;
        $category = $this->ormCategoryRepository->fetchById($id);
        $success = false;
        if($category){
            if($category->is_activated == 0){
                $result = $this->dbCategoryRepository->update($id, ['is_activated' => 1]);
            }else{
                $result = $this->dbCategoryRepository->update($id, ['is_activated' => 0]);
            }
            if($result){
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']);
    }

    function buildNewFolderPath($path, $fileName){
        $newPath = $path . '/' . $fileName;
        $newName = $fileName;
        $counter = 1;
        while (file_exists($newPath)) {
            $newName = $counter . '-' . $fileName;
            $newPath = $path . '/' . $newName;
            $counter++;
        }

        return array($newName, $newPath);
    }
}
