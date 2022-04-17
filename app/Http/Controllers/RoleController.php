<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
       public function  list_role(){
            $list_role = Role::all();
            return \view('admin.Auth_admin.list_role' , compact('list_role'));
        }
    //
}
