<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;

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
Route::get('/select-estimates',[EstimateController::class,'selectEtimates'])->name('select-estimates');
Route::get('/estimate',[EstimateController::class,'estimate'])->name('estimate');
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
Route::get('/new-request', [RequestController::class,'newRequest'])->name('newRequest');
Route::post('/save-new-request', [RequestController::class,'saveNewRequest'])->name('saveNewRequest');

Route::get('/select-date-estimates',[EstimateController::class,'selectDateEtimates'])->name('select-date-estimates');
Route::get('/search-estimates',[EstimateController::class,'searchEtimates'])->name('search-estimates');
Route::get('/search-estimates-from-req',[EstimateController::class,'searchEtimatesFromRequestInfos'])->name('search-estimates-from-req');


Route::get('/estimate_send',[EstimateController::class,'estimateSend'])->name('estimate_send');
Route::get('/select-send-estimates',[EstimateController::class,'selectSendEtimates'])->name('select-send-estimates');

Route::get('/select-send-date-estimates',[EstimateController::class,'selectSendDateEtimates'])->name('select-send-date-estimates');
Route::get('/search-send-estimates',[EstimateController::class,'searchSendEtimates'])->name('search-send-estimates');
Route::get('/requests',[RequestController::class,'request'])->name('request');
Route::delete('/delete-request/{id}', [RequestController::class, 'deleteRequest'])->name('delete-request');

Route::get('/searsh-request', [RequestController::class, 'searchRequest'])->name('searsh-request');
Route::get('/delete-selected-requests', [RequestController::class, 'deleteSelectedRequest'])->name('delete-selected-requests');

Route::get('/update-request-view', [RequestController::class, 'updateRequestView'])->name('update-request-view');
Route::post('/update-request-proceess', [RequestController::class, 'updateRequestProc'])->name('update-request-proceess');

Route::get('/request-infos-view/{id}', [RequestController::class, 'requestInfosView'])->name('request-infos-view');


Route::post('/add-user-review', [UserController::class, 'addUserReview'])->name('add-user-review');
Route::get('/profile-infos',[UserController::class,'profileInfos'])->name('profile-infos');
Route::get('/update-profile-infos',[UserController::class,'updateprofileInfos'])->name('update-profile-infos');
Route::post('/update-profile-infos-process',[UserController::class,'updateprofileInfosProcess'])->name('update-profile-infos-process');
Route::get('/main-search',[UserController::class,'searchMain'])->name('main-search');
Route::post('/main-search-proc',[UserController::class,'searchMainProc'])->name('main-search-proc');
Route::post('/offre-infos',[UserController::class,'offreInfos'])->name('offre-infos');
Route::post('/add-devis',[EstimateController::class,'addEstimate'])->name('add-devis');
Route::get('/checkunseenMessage',[baseApp::class,'checkunseenMessage'])->name('checkunseenMessage');
Route::get('/getunseenMessage',[baseApp::class,'checkunseenMessage'])->name('getunseenMessage');
Route::post('/send_email',[baseApp::class,'sendEmail'])->name('send_email');
