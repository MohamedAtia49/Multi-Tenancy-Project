<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

//Get Users from Every Single Database
Route::get('/landlord/login',function (){
    return view('auth.login');
})->name('landlord.login');

Route::get('/landlord/register',function (){
    return view('tenants.create');
})->name('landlord.register')->middleware('auth');


Route::get('/landlord',[HomeController::class,'index'])->name('landlord');


//Get the Sign up for new Tenant(User) || Create and new Database with this User
Route::get('/create/tenant',function (){
    return view('tenants.create');
})->name('tenant.create');

//Store the new user with his database
Route::post('/tenant/save',[TenantController::class,'store'])->name('tenant.store');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
