<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\LoginController@login');

Route::post('sendFeedback', 'API\ContactController@addFeedback');
Route::get('howitworks', 'API\HowItWorksController@index');
Route::get('privacypolicy', 'API\PrivacyPolicyController@index');
Route::get('termsofusage', 'API\TermsOfUsageController@index');

Route::resource('claims', 'API\ClaimController', [
    'only' => ['index', 'show']
]);
Route::resource('categories', 'API\CategoryController', [
    'only' => ['index', 'show']
]);
Route::get('/subcategories', 'API\CategoryController@subCategories');
Route::get('/certifications', 'API\CertificationController@index');
Route::get('/companies', 'API\CompanyController@getAll');

//Route::resource('certifications', 'API\CertificationController', ['except' => ['index', ////'show','update','destroy']]);
//Route::get('/certifications/{id}', 'API\CertificationController@certifications');
//Route::get('/certification/{idCompany}/{idCertification}', 'API\CertificationController@certification');
//Route::post('/certification/{id}', 'API\CertificationController@add');

//Route::delete('/certification/{idCompany}/{idCertification}', 'API\CertificationController@delete');

//Route::get('companies', 'API\CompanyController@index');
//Route::get('/company/{id}', 'API\CompanyController@show');

//Route::post('company', 'API\CompanyController@store');

//Route::get('/brands/{id}', 'API\BrandController@brands');
//Route::get('/brand/{idCompany}/{idBrand}', 'API\BrandController@brand');
//Route::put('/brand/{idCompany}/{idBrand}', 'API\BrandController@update');
//under this in middleware !
Route::middleware('auth:sanctum')->group( function () {
	Route::get('/companies/{idUser}', 'API\CompanyController@index');
	Route::get('/company/{idUser}/{idCompany}', 'API\CompanyController@show');
	Route::post('/company', 'API\CompanyController@store');
	Route::put('/update', 'API\CompanyController@update');
	Route::delete('/delete', 'API\CompanyController@delete');
	Route::post('/submitOnApproval', 'API\CompanyController@submitOnApproval');
});
