<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3/27/2018
 * Time: 3:12 PM
 */

namespace App\Repositories\Eloquents;
use App\Admin;

class OrmModeratorRepository
{
    private $admin;

    function __construct(){
        $this->admin = new Admin;
    }

    public function checkEmail($email){
        return $this->admin::where('email', $email)->first();
    }

    public function insert($data){
        $this->admin::create($data);
        return true;
    }
}