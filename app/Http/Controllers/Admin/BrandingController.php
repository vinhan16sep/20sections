<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use File;
use DateTime;

use App\Repositories\Eloquents\OrmBrandingRepository;
use App\Repositories\Db\DbBrandingRepository;

use App\Repositories\Eloquents\OrmCategoryRepository;

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
     * @var OrmCategoryRepository
     */
    protected $ormCategoryRepository;
    /**
     * BrandingController constructor.
     */
    public function __construct(
        OrmBrandingRepository $ormBrandingRepository,
        DbBrandingRepository $dbBrandingRepository,
        OrmCategoryRepository $ormCategoryRepository
        ){
        $this->middleware('auth:admin');

        $this->ormBrandingRepository = $ormBrandingRepository;
        $this->dbBrandingRepository = $dbBrandingRepository;
        $this->ormCategoryRepository = $ormCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $category = $this->ormCategoryRepository->fetchAll();

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
        $category = $this->ormCategoryRepository->fetchAll();
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
        $inputFile = Input::file('image');
        if($inputFile){
            $newFolderPath = $this->buildNewFolderPath($path, $inputFile->getClientOriginalName());
        }else{
            $newFolderPath = $this->buildNewFolderPath($path, $file);
        }

        $data =  ['name' => $input['name'], 'slug' => $uniqueSlug, 'description' => $input['description'], 'category_id' => $input['category_id']];
        if($inputFile){
            $data['image'] = $newFolderPath[0];
        }
        $data['created_by'] = Auth::guard('admin')->user()->email;
        $data['created_at'] = new DateTime();
        if($this->dbBrandingRepository->insert($data)){
            if($inputFile){
                $inputFile->move($path, $newFolderPath[0]);
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
        $category = $this->ormCategoryRepository->fetchAll();
        $branding = $this->ormBrandingRepository->fetchWithTableById($id);
        return view('admin.branding.edit', ['branding' => $branding, 'category' => $category]);
    }

    /**
     * @param BrandingRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BrandingRequest $request, $id){
        $branding = $this->ormBrandingRepository->fetchById($id);
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
        $data['updated_by'] = Auth::guard('admin')->user()->email;
        $inputFile = Input::file('image');
        if($inputFile){
            $data['image'] = $newFolderPath[0];
        }
        if($this->ormBrandingRepository->update($id, $data)){
            if($inputFile){
                File::delete($path.'/'.$branding->image);
                $inputFile->move($path, $newFolderPath[0]);
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
        $branding = $this->ormBrandingRepository->fetchById($id);
        $success = false;
        if($branding){
            $result = $this->dbBrandingRepository->update($id);
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
        $branding = $this->ormBrandingRepository->fetchById($id);
        $success = false;
        if($branding){
            if($branding->is_activated == 0){
                $result = $this->dbBrandingRepository->active($id, 1);
            }else{
                $result = $this->dbBrandingRepository->active($id, 0);
            }
            if($result){
                $success = true;
            }
        }
        return response()->json(['success' => $success, 'status' => '200']);
    }
}
