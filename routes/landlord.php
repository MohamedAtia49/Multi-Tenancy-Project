<?php

use App\Http\Controllers\TenantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//Get the Sign up for new Tenant(User) || Create and new Database with this User
Route::get('/create/tenant',function (){
    return view('tenants.create');
})->name('tenant.create');

//Store the new user with his database
Route::post('/tenant/save',[TenantController::class,'store'])->name('tenant.store');
