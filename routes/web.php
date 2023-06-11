<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

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

// Route::get('/', function () {
//     return view('base/auth/registration');
// });


Route::get('/user-infos',[RegistrationController::class,'userInfos']);
Route::post('/to-company-infos', [RegistrationController::class,'toCompanyInfos'])->name("to-company-infos");
Route::get('/company-infos', [RegistrationController::class,'companyInfos']);
Route::post('/to-user-category-infos', [RegistrationController::class,'toUserCategoryInfos'])->name("to-user-category-infos");
Route::get('/user-category-infos', [RegistrationController::class,'userCategoryInfos'])->name("user-category-infos");
