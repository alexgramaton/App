<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
		return view('auth.login');
});

Route::get('/home', function () {
		return view('auth.login');
});

Route::get('/verify/{token}', 'VerifyController@VerifyEmail')->name('verify');

Auth::routes([
  'register' => false,
  'verify' => true,
  'reset' => false
]);

Route::group(['middleware' => ['auth','admin']], function(){
	//Route::get('/dashboard', function () {
  //  return view('admin.dashboard');
	//});
	Route::get('/users', 'Admin\UserController@users');

	//Route::post('/register', 'Admin\RegistrationController@store');
	//Route::put('/updateUser/{id}','Admin\UserController@update');
	Route::get('/user-register', 'RegisterController@ShowRegisterForm')->name('register');
	Route::post('/user-register', 'RegisterController@HandleRegister');

	Route::delete('/deleteUser/{id}', 'Admin\UserController@delete');

	Route::get('/categories', 'Admin\CategoryController@categories');
	Route::post('/addCategory', 'Admin\CategoryController@add');
	Route::put('/updateCategory/{id}','Admin\CategoryController@update');
	Route::delete('/deleteCategory/{id}', 'Admin\CategoryController@delete');
	
	Route::get('/subcategories', 'Admin\SubCategoryController@subcategories');
	Route::post('/addSubCategory', 'Admin\SubCategoryController@add');
	Route::put('/updateSubCategory/{id}', 'Admin\SubCategoryController@update');
	Route::delete('/deleteSubCategory/{id}', 'Admin\SubCategoryController@delete');

	Route::get('/claims', 'Admin\ClaimController@claims');
	Route::post('/addClaim', 'Admin\ClaimController@add');
	Route::put('/updateClaim/{id}','Admin\ClaimController@update');
	Route::delete('/deleteClaim/{id}', 'Admin\ClaimController@delete');

	Route::get('/companies', 'Admin\CompanyController@companies');
	Route::put('/approveCompany/{id}', 'Admin\CompanyController@approveCompany');

	Route::get('/howItWorks', 'Admin\HowItWorksController@index');
	Route::post('/saveHowItWorks', 'Admin\HowItWorksController@store');

	Route::get('/termsOfUsage', 'Admin\TermsOfUsageController@index');
	Route::post('/saveTermsOfUsage', 'Admin\TermsOfUsageController@store');

	Route::get('/privacyPolicy', 'Admin\PrivacyPolicyController@index');
	Route::post('/savePrivacyPolicy', 'Admin\PrivacyPolicyController@store');
});