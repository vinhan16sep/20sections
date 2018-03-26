<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Branding;
use File;
use DateTime;

use App\Repositories\Eloquents\OrmBrandingRepository;
use App\Repositories\Db\DbBrandingRepository;

class BrandingController extends Controller
{

    /**
     * @var OrmBrandingRepository
     */
    protected $ormBrandingRepository;

    /**
     * @var DbBrandingRepository
     */
    protected $dbBrandingRepository;

    /**
     * BrandingController constructor.
     */
    public function __construct(OrmBrandingRepository $ormBrandingRepository, DbBrandingRepository $dbBrandingRepository){
        $this->middleware('auth:admin');

        $this->ormBrandingRepository = $ormBrandingRepository;
        $this->dbBrandingRepository = $dbBrandingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $category = DB::table('category')->get();

        $searchCriteria = [
            'name' => Input::get('search'),
            'category_id' => Input::get('category_id')
        ];

        $branding = $this->ormBrandingRepository->fetchAllWithPagination(10, $searchCriteria);

        $branding->setPath('branding?search=' . $searchCriteria['name'] . '&category_id=' . $searchCriteria['category_id']);
        return view('admin.branding.index', ['branding' => $branding, 'category' => $category, 'keyword' => $searchCriteria['name'], 'category_id' => $searchCriteria['category_id']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $category = DB::table('category')->get();
        return view('admin.branding.create', ['category' => $category]);
    }

    /**
     * @param BrandingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BrandingRequest $request){
        $path = base_path() . '/storage/app/branding/';
        $input = $request->all();
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('branding', $request->id, $slug);
        $file = null;
        if(Input::file('image')){
            $file = Input::file('image')->getClientOriginalName();
        }
        $newFolderPath = $this->buildNewFolderPath($path, $file);
        $data =  ['name' => $input['name'], 'slug' => $uniqueSlug, 'description' => $input['description'], 'category_id' => $input['category_id']];
        if(Input::file('image')){
            $data['image'] = $newFolderPath[0];
        }
        $data['created_at'] =new DateTime();
        if(DB::table('branding')->insert($data)){
            if(Input::file('image')){
                Input::file('image')->move($path, $newFolderPath[0]);
            }
        }
        return redirect()->intended('20s-admin/branding');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $category = DB::table('category')->get();
        $branding = Branding::with('category')->where(['is_deleted'=> 0, 'id' => $id])->first();
        return view('admin.branding.edit', ['branding' => $branding, 'category' => $category]);
    }

    /**
     * @param BrandingRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BrandingRequest $request, $id){
        $category = Branding::findOrFail($id);
        $path = base_path() . '/storage/app/branding/';
        $input = $request->all();
        $file = null;
        if(Input::file('image')){
            $file = Input::file('image')->getClientOriginalName();
        }
        $slug = str_slug($request->input('name'));
        $uniqueSlug = $this->buildUniqueSlug('category', $request->id, $slug);
        $newFolderPath = $this->buildNewFolderPath($path, $file);
        $data =  ['name' => $input['name'], 'slug' => $uniqueSlug, 'description' => $input['description'], 'category_id' => $input['category_id']];
        $data['updated_at'] =new DateTime();
        if(Input::file('image')){
            $data['image'] = $newFolderPath[0];
        }
        if(DB::table('branding')->where('id', $id)->update($data)){
            if(Input::file('image')){
                File::delete($path.'/'.$category->image);
                Input::file('image')->move($path, $newFolderPath[0]);
            }
        }
        return redirect()->intended('20s-admin/branding');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Request $request){
        $id = $request->id;
        $branding = Branding::findOrFail($id);
        $success = false;
        if($branding){
            $result = DB::table('branding')
            ->where('id', $id)
            ->update(['is_deleted' => 1]);
            if($result){
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(Request $request){
        $id = $request->id;
        $branding = Branding::findOrFail($id);
        $success = false;
        if($branding){
            if($branding->is_activated == 0){
                $result = DB::table('branding')
                ->where('id', $id)
                ->update(['is_activated' => 1]);
            }else{
                $result = DB::table('branding')
                ->where('id', $id)
                ->update(['is_activated' => 0]);
            }
            if($result){
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']);
    }
}
