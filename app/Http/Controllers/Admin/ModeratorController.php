<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ModeratorRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Session;
use App\Admin;

use App\Repositories\Eloquents\OrmModeratorRepository;

class ModeratorController extends Controller
{
    /**
     * @var OrmModeratorRepository
     */
    protected $ormModeratorRepository;
    public function __construct(OrmModeratorRepository $ormModeratorRepository)
    {
        $this->middleware('auth:admin');
        $this->ormModeratorRepository = $ormModeratorRepository;
    }

    public function showRegisterForm()
    {
    	return view('admin.moderator.register');
    }

    /**
     * @param ModeratorRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(ModeratorRequest $request)
    {

        $checkEmail = $this->ormModeratorRepository->checkEmail($request->input('email'));
        if(!empty($checkEmail)){
            Session::flash('message', 'Email đã tồn tại');
            return redirect('20s-admin/register');
        }
        $admin = new Admin;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 88;
        unset($input['password_confirmation']);
        $createAdmin = $this->ormModeratorRepository->insert($input);
        
        if($createAdmin == true){
            return redirect('20s-admin');
        }
    }
}
