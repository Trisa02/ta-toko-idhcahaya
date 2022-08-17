<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModel;
use Session;
use Illuminate\Support\Facades\DB;


class HomeadminController extends Controller
{
    public function indexAdmin (){
        $admin['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        // dd($admin);
        return view ('backend.dashboard',$admin);
    }
}
