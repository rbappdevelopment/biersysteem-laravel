<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiersysteemController;
use App\Http\Controllers\AdminController;
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

//Biersysteem routes
Route::get('/', [BiersysteemController::class, 'LoadBierstandData']);
Route::post('/update', [BiersysteemController::class, 'UpdateBierstand']);

//Admin routes
Route::get('/admin/addperson', [AdminController::class, 'LoadAdminPage_AddPerson']);
Route::post('/admin/addperson', [AdminController::class, 'AddPerson'])->name('addperson');
Route::get('/admin/editperson', [AdminController::class, 'LoadAdminPage_EditPerson']);
Route::post('/admin/editperson/{id}', [AdminController::class, 'UpdateValue'])->name('updateperson');
Route::post('/admin/editperson/{id}/name', [AdminController::class, 'UpdateName'])->name('updatename');
Route::post('/admin/editperson/{id}/delete', [AdminController::class, 'DeletePerson'])->name('deletename');
Route::get('/admin/person/{id}/mutations', [AdminController::class, 'GetMutationsForUser']);

//Authentication & authorization
Route::group(['prefix' => 'biersysteem'], function () {
    Auth::routes();
});

//clear routes
Route::get('/clear/routes', [AdminController::class, 'ClearRoutes']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
