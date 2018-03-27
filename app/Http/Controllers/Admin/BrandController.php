<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Mail;
use App\User;
use Validator;
use Session;

class BrandController extends Controller
{

    public function showRegisterForm()
    {
    	return view('admin.brand.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function brandRegister(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ],[
            'name.required' => 'Họ tên không được trống',
            'email.required' => 'Địa chỉ Email không được trống',
            'password.required' => 'Mật khẩu không được trống',
            'password_confirmation.required' => 'Xác nhận email không được trống',
            'email.email' => 'Định dạng Email không đúng',
            'password.min' => 'Mật khẩu phải lớn hơn 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng',
        ]);

        $checkEmail = DB::table('users')->where('email', $request->input('email'))->first();
        if(!empty($checkEmail)){
            Session::flash('message', 'Email đã tồn tại');
            return redirect('20s-admin/brand/register');
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 98;
        $input['verification_code']  = str_random(20);
        // print_r($input);die;
        $user = User::create($input);
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
        $keyword = Input::get('search');
        $dateRange = Input::get('search_date');
        $dateFrom = null;
        $dateTo = null;
        if($dateRange != ''){
            $date = explode(' - ', $dateRange);
            if(count($date) == 2){
                $dateFrom = date('Y:m:d',strtotime($date[0]));
                $dateTo = date('Y:m:d 23:59:59',strtotime($date[1]));
            }
        }
        $brand = User::whereExists(function ($query) use ($dateRange, $dateFrom, $dateTo, $keyword){
            $query->where('role', 98);
            if ($dateRange != ''){
                $query->where([
                    ['created_at', '>=', $dateFrom],
                    ['created_at', '<=', $dateTo]
                ]);
            }
            if ($keyword != ''){
                $query->where('name', 'like', '%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%');
            }
        })->get();
        return view('admin.brand.index', ['brand' => $brand, 'dateRange' => $dateRange, 'keyword' => $keyword]);
    }
}

