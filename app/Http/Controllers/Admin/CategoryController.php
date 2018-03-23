<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Category;
use File;
use DateTime;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $category = DB::table('category')->where('is_deleted', 0)->paginate(10);
        $keyword = Input::get('search');
        if($keyword != ''){
            $category = DB::table('category')
                            ->where([
                                ['is_deleted' , 0],
                                ['name', 'like', '%'.$keyword.'%']
                            ])->paginate(1);
            $category->setPath('category?search='.$keyword);
        }
        

        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $path = base_path() . '/storage/app/category/';
        $input = $request->all();
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('category', $request->id, $slug);
        $file = null;
        if(Input::file('image')){
            $file = Input::file('image')->getClientOriginalName();
        }
        $newFolderPath = $this->buildNewFolderPath($path, $file);
        $data =  ['name' => $input['name'], 'slug' => $uniqueSlug, 'description' => $input['description']];
        // File::makeDirectory($newFolderPath[1], 0777, true, true);
        if(Input::file('image')){
            $data['image'] = $newFolderPath[0];
        }
        $data['created_at'] =new DateTime();
        if(DB::table('category')->insert($data)){
            if(Input::file('image')){
                Input::file('image')->move($path, $newFolderPath[0]);
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
        $category = Category::find($id);
        return view('admin.category.edit', ['category' => $category]);
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

        $category = Category::findOrFail($id);
        $path = base_path() . '/storage/app/category/';
        $input = $request->all();
        $file = null;
        if(Input::file('image')){
            $file = Input::file('image')->getClientOriginalName();
        }
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('category', $request->id, $slug);
        $newFolderPath = $this->buildNewFolderPath($path, $file);
        $data = ['name' => $input['name'], 'slug' => $uniqueSlug, 'description' => $input['description']];
        $data['updated_at'] =new DateTime();
        if(Input::file('image')){
            $data['image'] = $newFolderPath[0];
        }
        if(DB::table('category')->where('id', $id)->update($data)){
            if(Input::file('image')){
                File::delete($path.'/'.$category->image);
                Input::file('image')->move($path, $newFolderPath[0]);
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
        $category = Category::findOrFail($id);
        $success = false;
        if($category){
            $result = DB::table('category')
            ->where('id', $id)
            ->update(['is_deleted' => 1]);
            if($result){
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']); 
    }

    public function active(Request $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);
        $success = false;
        if($category){
            if($category->is_activated == 0){
                $result = DB::table('category')
                ->where('id', $id)
                ->update(['is_activated' => 1]);
            }else{
                $result = DB::table('category')
                ->where('id', $id)
                ->update(['is_activated' => 0]);
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

    protected function validateRequest($request){
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required' => 'Tiêu đề không được trống',
        ]);
    }
}
