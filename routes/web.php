<?php

use App\Mail\NotificationMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

Route::post('/availability/{equipment}',[\App\Http\Controllers\Availability::class,'availability']);

Route::get('/mail', function () {
    $user = User::all();
    $msg = "Um MCSCR foi criado para o Equipamento ESCAVADORA ESC 01, Ref: ESC 01. Este Equipamento estará indisponível até fechar o MCSCR. \n
    Equipamento: ESCAVADORA ESC 01.\n
    Referencia: ESC 01.\n
    O motivo da paralização: Motivo de paralização.\n
    Hora da paralização: 2022-09-17T13:25";

    foreach ($user as $item) {
        return new \App\Mail\NotificationMail($item,$msg);
    }
    // return new \App\Mail\NotificationMail($user);
    // return Mail::send(new NotificationMail($user));
    //  return new \App\Mail\NotificationMail($user,$msg);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('get-equipment', [App\Http\Controllers\Manutencao\MCSCRController::class, 'getEquipment']);
Route::post('get-equipment-area', [App\Http\Controllers\Area\MCSCRController::class, 'getEquipment']);
Route::post('get-equipment-operador', [App\Http\Controllers\Operador\MCSCRController::class, 'getEquipment']);


Route::group(['middleware'=>['auth','admin']], function(){
    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');
    Route::resource('notifications-admin', 'App\Http\Controllers\Admin\NotificationController');
    Route::get('/deleteall-admin',[\App\Http\Controllers\Admin\NotificationController::class,'deleteall']);
    Route::resource('profile-admin', 'App\Http\Controllers\Admin\ProfileController');

    Route::post('upload-users',[\App\Http\Controllers\Admin\UsersController::class,'upload']);


});

Route::group(['middleware'=>['auth','administracao']], function(){

    

});

Route::group(['middleware'=>['auth','planning']], function(){

    Route::resource('planning', 'App\Http\Controllers\Planning\PlanningController');
    Route::resource('notifications-planning', 'App\Http\Controllers\Planning\NotificationController');
    Route::get('/deleteall-planning',[\App\Http\Controllers\Planning\NotificationController::class,'deleteall']);
    Route::resource('profile-planning', 'App\Http\Controllers\Planning\ProfileController');
    Route::resource('brigadeplanning', 'App\Http\Controllers\Planning\BrigadeController');
    Route::resource('operatorplanning', 'App\Http\Controllers\Planning\OperatorController');
    Route::resource('equipmentplanning', 'App\Http\Controllers\Planning\EquipmentController');
    Route::get('/planning/{planning_id}/brigade/{brigade_id}', [App\Http\Controllers\Planning\OperatorController::class, 'index']);
    Route::get('/planning/{planning_id}/equipmentrequest/{request_id}', [App\Http\Controllers\Planning\EquipmentController::class, 'index']);
    Route::resource('shiftdashboard-planning', 'App\Http\Controllers\Planning\ShiftDashboardController');

    

});

// Route::group(['middleware'=>['auth','area']], function(){
//     Route::resource('notifications-area', 'App\Http\Controllers\Area\NotificationController');
//     Route::get('/deleteall-area',[\App\Http\Controllers\Area\NotificationController::class,'deleteall']);
//     Route::resource('profile-area', 'App\Http\Controllers\Area\ProfileController');

// });

Route::group(['middleware'=>['auth','supervisor']], function(){
    Route::resource('planning-supervisor', 'App\Http\Controllers\Supervisor\PlanningController');
    Route::resource('notifications-supervisor', 'App\Http\Controllers\Supervisor\NotificationController');
    Route::get('/deleteall-supervisor',[\App\Http\Controllers\Supervisor\NotificationController::class,'deleteall']);
    Route::resource('profile-supervisor', 'App\Http\Controllers\Supervisor\ProfileController');
    Route::resource('equipmentitem-supervisor', 'App\Http\Controllers\Supervisor\EquipmentController');
    Route::resource('shiftdashboard-supervisor', 'App\Http\Controllers\Supervisor\ShiftDashboardController');

    Route::get('/planning-supervisor/{planning_id}/brigade/{brigade_id}', [App\Http\Controllers\Supervisor\OperatorController::class, 'index']);
    Route::get('/planning-supervisor/{planning_id}/equipmentrequest/{request_id}', [App\Http\Controllers\Supervisor\EquipmentController::class, 'index']);

});

Route::group(['middleware'=>['auth','operadorcoordenador']], function(){
    Route::resource('notifications-operadorc', 'App\Http\Controllers\OperadorC\NotificationController');
    Route::get('/deleteall-operadorc',[\App\Http\Controllers\OperadorC\NotificationController::class,'deleteall']);
    Route::resource('profile-operadorc', 'App\Http\Controllers\OperadorC\ProfileController');



});


Route::group(['middleware'=>['auth','operador']], function(){

    Route::resource('mcscr-operador', 'App\Http\Controllers\Operador\MCSCRController');
    Route::resource('notifications-operador', 'App\Http\Controllers\Operador\NotificationController');
    Route::get('/deleteall-operador',[\App\Http\Controllers\Operador\NotificationController::class,'deleteall']);
    Route::resource('profile-operador', 'App\Http\Controllers\Operador\ProfileController');
    Route::resource('equipmentresult-operador', 'App\Http\Controllers\Operador\OperatorEquipmentController');

   

});

Route::group(['middleware'=>['auth','manutencao']], function(){
    Route::resource('report', 'App\Http\Controllers\Manutencao\ReportsController');
    Route::resource('equipment', 'App\Http\Controllers\Manutencao\EquipmentController');
    Route::resource('type_equipment', 'App\Http\Controllers\Manutencao\TypeEquipmentController');
    Route::resource('equipmentrequest', 'App\Http\Controllers\Manutencao\EquipmentRequestController');
    Route::resource('mcscr', 'App\Http\Controllers\Manutencao\MCSCRController');
    Route::resource('destination', 'App\Http\Controllers\Manutencao\DestinationController');
    Route::resource('area', 'App\Http\Controllers\Manutencao\AreaController');
    Route::resource('availability', 'App\Http\Controllers\Manutencao\AvailabilityController');
    Route::resource('profile-manutencao', 'App\Http\Controllers\Manutencao\ProfileController');
    Route::resource('notifications-manutencao', 'App\Http\Controllers\Manutencao\NotificationController');
    Route::get('/deleteall-manutencao',[\App\Http\Controllers\Manutencao\NotificationController::class,'deleteall']);
    Route::resource('availabilityarea', 'App\Http\Controllers\Manutencao\AvailabilityAreaController');
    
    Route::resource('meeting', 'App\Http\Controllers\Administracao\MeetingController');
    Route::resource('meetingparticipant', 'App\Http\Controllers\Administracao\MeetingParticipantController');
    Route::resource('meetingtask', 'App\Http\Controllers\Administracao\MeetingTaskController');
    Route::get('/download-ata/{meeting}',[\App\Http\Controllers\Administracao\MeetingController::class,'download']);
    Route::post('/sendmail/participant', [App\Http\Controllers\Administracao\MeetingController::class, 'sendmail'])->name('home');

    

});


Route::group(['middleware'=>['auth','area_manutencao']], function(){

    Route::resource('equipment-area', 'App\Http\Controllers\Area\EquipmentController');
    Route::resource('type_equipment-area', 'App\Http\Controllers\Area\TypeEquipmentController');
    Route::resource('notifications-area', 'App\Http\Controllers\Area\NotificationController');
    Route::get('/deleteall-area',[\App\Http\Controllers\Area\NotificationController::class,'deleteall']);
    Route::resource('mcscr-area', 'App\Http\Controllers\Area\MCSCRController');
    Route::resource('availability-area', 'App\Http\Controllers\Area\AvailabilityController');
    Route::resource('profile-area', 'App\Http\Controllers\Area\ProfileController');


});


