<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandRequest;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Mail;
use App\User;
use Validator;
use Session;

use App\Repositories\Eloquents\OrmUserRepository;

class BrandController extends Controller
{
    /**
     * @var OrmUserRepository
     */
    protected $ormUserRepository;

    public function __construct(OrmUserRepository $ormUserRepository)
    {
        $this->ormUserRepository = $ormUserRepository;
    }

    public function showRegisterForm()
    {
    	return view('admin.brand.register');
    }

    /**
     * @param BrandRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function brandRegister(BrandRequest $request){

        $checkEmail = DB::table('users')->where('email', $request->input('email'))->first();
        if(!empty($checkEmail)){
            Session::flash('message', 'Email đã tồn tại');
            return redirect('20s-admin/brand/register');
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 98;
        $input['created_by'] = Auth::guard('admin')->user()->email;
        $input['verification_code']  = str_random(20);
        // print_r($input);die;
        $user = $this->ormUserRepository->insert($input);
        $success['token'] =  $user->createToken('Brand')->accessToken;
        $success['name'] =  $user->name;
        if($user == true){
        	$data['name']  = $input['name'];
            $data['password']  = $request->password;
        	$data['verification_code']  = $input['verification_code'];
        	Mail::send('admin/brand/send-mail', $data, function($message) use ($input)
            {
                $message->subject("Welcome to site name");
                $message->to($input['email']);
            });

        	return redirect('20s-admin');
        }
    }

    public function index(){
        $searchCriteria = [
            'name' => Input::get('search'),
            'dateRange' => Input::get('search_date'),
        ];

        $dateFrom = null;
        $dateTo = null;
        if($searchCriteria['dateRange'] != ''){
            $date = explode(' - ', $searchCriteria['dateRange']);
            if(count($date) == 2){
                $dateFrom = date('Y-m-d',strtotime($date[0]));
                $dateTo = date('Y-m-d 23:59:59',strtotime($date[1]));
            }
        }
        $brand = $this->ormUserRepository->fetchAllWithPagination(10, $searchCriteria, $dateFrom, $dateTo, 98);
        $brand->setPath('brand?search='.$searchCriteria['name'].'&search_date='.$searchCriteria['dateRange']);
        return view('admin.brand.index', ['brand' => $brand, 'dateRange' => $searchCriteria['dateRange'], 'keyword' => $searchCriteria['name']]);
    }
}

