<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\baseApp;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;

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

Route::get('/',[baseApp::class,'index'])->name('home');
Route::get('/dashboard',[baseApp::class,'dashboard'])->name('dashboard');
Route::get('/select-estimates',[baseApp::class,'selectEtimates'])->name('select-estimates');
Route::get('/estimate',[baseApp::class,'estimate'])->name('estimate');
Route::get('/login',[RegistrationController::class,'signInView'])->name('login');
Route::post('/loginProc',[RegistrationController::class,'signIn'])->name('loginProc');

Route::get('/user-infos',[RegistrationController::class,'userInfos'])->name("user-infos");
Route::post('/to-company-infos', [RegistrationController::class,'toCompanyInfos'])->name("to-company-infos");
Route::get('/company-infos', [RegistrationController::class,'companyInfos']);
Route::post('/to-user-category-infos', [RegistrationController::class,'toUserCategoryInfos'])->name("to-user-category-infos");
Route::get('/user-category-infos', [RegistrationController::class,'userCategoryInfos'])->name("user-category-infos");
Route::post('/signUp-user', [RegistrationController::class,'signUp'])->name('signUp-user');


Route::get('/back-user-infos', [RegistrationController::class,'backToUserInfo'])->name('back-user-infos');
Route::get('/back-company-infos', [RegistrationController::class,'backToCompanyInfos'])->name('back-company-infos');
Route::get('/new-request', [baseApp::class,'newRequest'])->name('newRequest');
Route::post('/save-new-request', [baseApp::class,'saveNewRequest'])->name('saveNewRequest');
