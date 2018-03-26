<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use App\Admin;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showRegisterForm()
    {
    	return view('admin.moderator.register');
    }

    public function register(Request $request)
    {
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

        $checkEmail = DB::table('admins')->where('email', $request->input('email'))->first();
        if(!empty($checkEmail)){
            Session::flash('message', 'Email đã tồn tại');
            return redirect('20s-admin/register');
        }
        $admin = new Admin;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 88;
        unset($input['password_confirmation']);
        $createAdmin = Admin::create($input);
        
        if($createAdmin == true){
            return redirect('20s-admin');
        }
    }
}
