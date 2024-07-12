<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        // dd(DB::getDefaultConnection());
        $users = DB::table('users')->get()->toArray();
        return view('welcome',compact('users'));
    }
}
