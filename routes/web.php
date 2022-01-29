<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CancerTypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Route::get('/enquiry-form', function () {
    return view('patient-details');
});*/
//Route::get('/getCities/{id}','\App\Http\Controllers\PatientDetailController::class@');
Route::get('/getCities',[\App\Http\Controllers\PatientDetailController::class, 'index']);
Route::get('/getCities/{id}',[\App\Http\Controllers\PatientDetailController::class, 'getCities']);

Route::resource('/',\App\Http\Controllers\PatientDetailController::class);
Route::resource('/patientdetails',\App\Http\Controllers\PatientDetailController::class);

Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');
//Route::get('/login', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/authenticate', [\App\Http\Controllers\UserController::class, 'authenticate'])->name('authenticate');
Route::get('/doctor/dashboard', [\App\Http\Controllers\UserController::class, 'dashboard']);
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');



Route::group(['middleware'=>'auth'], function() {
    Route::group( ['prefix' => 'admin', 'middleware' => 'admin'], function() {
        Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admindashboard')->middleware('admin');
        Route::get('doctor', [\App\Http\Controllers\AdminController::class, 'createDoctor'])->name('createdoctor')->middleware('admin');

        //Cancer types managed with below route
        Route::resource('cancertype', CancerTypeController::class);

        //Doctors management route  added below
        Route::post('/doctors/register', [AdminController::class,'register'])->name('doctors.register');
        Route::post('/doctors/store', [UserController::class,'store'])->name('doctors.store');
        Route::patch('/doctors/{id}', [UserController::class,'update'])->name('doctors.update');
        Route::get('/doctors/create', [UserController::class,'create'])->name('doctors.create');
        Route::get('/doctors/show/{id}', [UserController::class,'show'])->name('doctors.show');
        Route::get('/doctors/edit/{id}', [UserController::class,'edit'])->name('doctors.edit');
        Route::delete('/doctors/destroy/{id}', [UserController::class,'destroy'])->name('doctors.destroy');
        Route::get('/doctors', [UserController::class,'index'])->name('doctors.index');

    });
 
        Route::post('/doctor/enquiry-details/{id}',[AdminController::class,'enquiryCreatePlan'])->name('doctor.enquiry-details');
        Route::get('/doctor/enquiry-details/{id}',[AdminController::class,'enquiryDetails'])->name('doctor.enquiry-details');
        Route::get('/doctor/dashboard',[AdminController::class,'showEnquiry'])->name('doctors.dashboard');


});
