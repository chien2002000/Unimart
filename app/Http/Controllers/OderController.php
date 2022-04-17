<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OderController extends Controller
{
        public function list(){
            return \view('admin.oder.list_oder');
        }
    //
}
