<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware'=>['auth','admin']], function(){
    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');

});

Route::group(['middleware'=>['auth','planning']], function(){

    Route::resource('planning', 'App\Http\Controllers\Planning\PlanningController');
    Route::resource('brigadeplanning', 'App\Http\Controllers\Planning\BrigadeController');
    Route::resource('operatorplanning', 'App\Http\Controllers\Planning\OperatorController');
    Route::resource('equipmentplanning', 'App\Http\Controllers\Planning\EquipmentController');
    Route::get('/planning/{planning_id}/brigade/{brigade_id}', [App\Http\Controllers\Planning\OperatorController::class, 'index']);

    

});

Route::group(['middleware'=>['auth','area']], function(){

});

Route::group(['middleware'=>['auth','supervisor']], function(){

});

Route::group(['middleware'=>['auth','operadorc']], function(){

});


Route::group(['middleware'=>['auth','operador']], function(){

    Route::resource('mcscr-operador', 'App\Http\Controllers\Operador\MCSCRController');

});

Route::group(['middleware'=>['auth','manutencao']], function(){

    Route::resource('equipment', 'App\Http\Controllers\Manutencao\EquipmentController');
    Route::resource('type_equipment', 'App\Http\Controllers\Manutencao\TypeEquipmentController');
    Route::resource('equipmentrequest', 'App\Http\Controllers\Manutencao\EquipmentRequestController');
    Route::resource('mcscr', 'App\Http\Controllers\Manutencao\MCSCRController');
    Route::resource('destination', 'App\Http\Controllers\Manutencao\DestinationController');
    Route::resource('profile-manutencao', 'App\Http\Controllers\Manutencao\ProfileController');
    Route::resource('notifications-manutencao', 'App\Http\Controllers\Manutencao\NotificationController');
    Route::get('/deleteall',[\App\Http\Controllers\Manutencao\NotificationController::class,'deleteall']);
   
   

});


