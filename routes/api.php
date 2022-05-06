<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\PrsnadministrativeController;
use App\Models\Prsnadministrative;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/reservation' , [AdministratorController::class , 'showreservation']);



//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//this Route for Administrator
//and this is all what we need for generate teachers information
Route::post('Administratorlogin', [AdministratorController::class , 'login'])->middleware('isadministrator');

Route::post('/logout' , [AdministratorController::class , 'logout'])->middleware('isadministrator');
Route::get('/teachers' , [AdministratorController::class , 'ShowAllTeachers'])->middleware('isadministrator');
Route::post('/teachers/add' , [AdministratorController::class , 'addteacher'])->middleware('isadministrator');
Route::get('/teachers/{email}/edit' , [AdministratorController::class , 'showeditteacher'])->middleware('isadministrator');
Route::post('/teachers/edit/{email}' , [AdministratorController::class , 'editteacher'])->middleware('isadministrator');
Route::get('/teachers/delete/{email}' , [AdministratorController::class , 'deleteteacher'])->middleware('isadministrator');


//and this is all what we need for generate room information
Route::get('/rooms' , [AdministratorController::class , 'ShowAllRooms'])->middleware('isadministrator');
Route::post('/rooms/add' , [AdministratorController::class , 'addroom'])->middleware('isadministrator');
Route::get('/rooms/{roomname}/edit' , [AdministratorController::class , 'showeditroom'])->middleware('isadministrator');
Route::post('/rooms/edit/{roomname}' , [AdministratorController::class , 'editroom'])->middleware('isadministrator');
Route::get('/rooms/delete/{roomname}' , [AdministratorController::class , 'deleteroom'])->middleware('isadministrator');



//and this is all what we need for generate materials information
Route::get('/materials' , [AdministratorController::class , 'ShowAllmaterials'])->middleware('isadministrator');
Route::post('/materials/add' , [AdministratorController::class , 'addmaterials'])->middleware('isadministrator');
Route::get('/materials/{id}/edit' , [AdministratorController::class , 'showeditmaterials'])->middleware('isadministrator');
Route::post('/materials/edit/{id}' , [AdministratorController::class , 'editmaterials'])->middleware('isadministrator');
Route::get('/materials/delete/{id}' , [AdministratorController::class , 'deletematerials'])->middleware('isadministrator');




//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//this Route for Prsnadministrative
Route::post('Prsnadministrativelogin', [PrsnadministrativeController::class , 'login'])->middleware('isprsnadministrative');




//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//this Route for Teacher
Route::post('Teacherlogin', [TeacherController::class , 'login'])->middleware('isteacher');
Route::post('/availablerooms', [TeacherController::class , 'availablerooms'])->middleware('isteacher');
Route::post('/reservation/add' , [AdministratorController::class , 'addteacher'])->middleware('isadministrator');
