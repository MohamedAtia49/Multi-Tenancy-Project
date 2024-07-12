<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::get('/', function (Request $request) {
//     $host = $request::getHost();
//     dd($host);
// });


//return to the home page with current domain signed and his database
// Route::get('/users',[HomeController::class,'index'])->name('default');


//Get Users from Every Single Database
// Route::get('/users',function(){
//     $users = DB::table('users')->get()->toArray();
//     dd($users);
// });

Route::get('/',[HomeController::class,'index'])->name('default');


//Get the Database connection from every single database
Route::get('/tenant/connection',[TenantController::class , 'index']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/test',function(){

    $dbUser = config('create_tenant.DB_USERNAME');
    dd($dbUser);
})->middleware('auth');

Auth::routes();
