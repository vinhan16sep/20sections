<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandRequest;
use App\Http\Requests\ProductRequest;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Mail;
use App\User;
use Validator;
use Session;


use App\Repositories\Eloquents\OrmUserRepository;
use App\Repositories\Eloquents\OrmCategoryRepository;
use App\Repositories\Eloquents\OrmProductRepository;
use App\Repositories\Db\DbBrandingRepository;


class UserController extends Controller {
    /**
     * @var OrmUserRepository
     */
    protected $ormUserRepository;
    /**
     * @var OrmCategoryRepository
     */
    protected $ormCategoryRepository;
    /**
     * @var OrmProductRepository
     */
    protected $ormProductRepository;
    /**
     * @var DbBrandingRepository
     */
    protected $dbBrandingRepository;

    public function __construct(
        OrmUserRepository $ormUserRepository,
        OrmCategoryRepository $ormCategoryRepository,
        OrmProductRepository $ormProductRepository,
        DbBrandingRepository $dbBrandingRepository
    ) {
        $this->ormUserRepository = $ormUserRepository;
        $this->ormCategoryRepository = $ormCategoryRepository;
        $this->ormProductRepository = $ormProductRepository;
        $this->dbBrandingRepository = $dbBrandingRepository;
    }

    public function showRegisterForm() {
        return view('admin.brand.register');
    }

    /**
     * @param BrandRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function brandRegister(BrandRequest $request) {

        $countEmail = $this->ormUserRepository->countEmail($request->input('email'));
        if ($countEmail != 0) {
            Session::flash('message', Config::get('constants.MESSAGE.EMAIL_EXIST'));
            return redirect('20s-admin/brand/register');
        }

        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => Config::get('constants.ROLE_NUMBER.BRAND'),
            'created_by' => Auth::guard('admin')->user()->email,
            'updated_by' => Auth::guard('admin')->user()->email
        ];
        $user = $this->ormUserRepository->insert($input);

        if ($user) {
            $mailContent = [
                'name' => $request->name,
                'password' => $request->password
            ];
            $send = $this->mail($mailContent, $request->email);

            if($send){
                return redirect('20s-admin/brand');
            }else{
                Session::flash('message', Config::get('constants.MESSAGE.EMAIL_ERROR'));
                return redirect('20s-admin/brand/register');
            }

        }
    }

    public function index() {
        $searchCriteria = [
            'name' => Input::get('search'),
            'dateRange' => Input::get('search_date'),
        ];

        $dateFrom = null;
        $dateTo = null;
        if ($searchCriteria['dateRange'] != '') {
            $date = explode(' - ', $searchCriteria['dateRange']);
            if (count($date) == 2) {
                $dateFrom = date('Y-m-d', strtotime($date[0]));
                $dateTo = date('Y-m-d 23:59:59', strtotime($date[1]));
            }
        }
        $brand = $this->ormUserRepository->fetchAllWithPagination(10, $searchCriteria, $dateFrom, $dateTo, 98);
        $brand->setPath('brand?search=' . $searchCriteria['name'] . '&search_date=' . $searchCriteria['dateRange']);
        return view('admin.brand.index', ['brand' => $brand, 'dateRange' => $searchCriteria['dateRange'], 'keyword' => $searchCriteria['name']]);
    }

    public function detail() {
        $id = Input::get('id');
        $user = $this->ormUserRepository->fetchById($id);
        $category = $this->ormCategoryRepository->fetchAll();
        $searchCriteria = [
            'name' => Input::get('search'),
            'category_id' => Input::get('category_id'),
            'branding_id' => Input::get('branding_id')
        ];
        // print_r($chart);die;
        $product = $this->ormProductRepository->fetchAllWithBrandId(10, $searchCriteria, $id);
        $product->setPath('brand-detail?search=' . $searchCriteria['name'] . '&category_id=' . $searchCriteria['category_id'] . '&branding_id=' . $searchCriteria['branding_id'] . '&id=' . $id);
        return view('admin.brand.detail', [
            'user' => $user,
            'category' => $category,
            'product' => $product,
            'keyword' => $searchCriteria['name'],
            'category_id' => $searchCriteria['category_id'],
            'branding_id' => $searchCriteria['branding_id']
        ]);
    }

    public function detailProduct(Request $request) {
        $id = $request->productId;
        $success = false;
        $product = $this->ormProductRepository->fetchByIdWithRelationData($id);

        $categoryId = $request->categoryId;
        $branding = $this->dbBrandingRepository->fetchByCategoryId($categoryId);
        if ($branding->toArray() != null && $product) {
            $success = true;
        }
        return response()->json(['success' => $success, 'product' => $product, 'branding' => $branding, 'status' => '200']);
    }

    private function mail($content, $mailTo) {
        Mail::send('admin/brand/send-mail', $content, function ($message) use ($mailTo) {
            $message->subject("Welcome to site name");
            $message->to($mailTo);
        });

        return (count(Mail::failures()) > 0) ? false : true;
    }

}

