<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TimingController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\PrsnadministrativeController;
use App\Models\Administrator;
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

Route::post('/showreservation' , [AdministratorController::class , 'showreservation']);
Route::post('/showmyreservation' , [TeacherController::class , 'showmyreservation']);
Route::get('/allshowroom' , [AdministratorController::class , 'showrooms']);



//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//this Route for Administrator
//and this is all what we need for generate teachers information

Route::post('/userLogin', [AdministratorController::class , 'login']);//->middleware('isadministrator');
// Route::post('/user', [AdministratorController::class , 'userLoginNew']);//->middleware('isadministrator');

Route::post('/logout' , [AdministratorController::class , 'logout']);//->middleware('isadministrator');
Route::get('/ShowAllTeachers' , [AdministratorController::class , 'ShowAllTeachers']);//->middleware('isadministrator');
Route::post('addteacher' , [AdministratorController::class , 'addteacher']);//->middleware('isadministrator');
//Route::get('/teachers/edit' , [AdministratorController::class , 'showeditteacher']);//->middleware('isadministrator');
Route::post('/editteacher' , [AdministratorController::class , 'editteacher']);//->middleware('isadministrator');
Route::post('/deleteteacher' , [AdministratorController::class , 'deleteteacher']);//->middleware('isadministrator');


//and this is all what we need for generate room information
Route::get('/ShowAllRooms' , [AdministratorController::class , 'ShowAllRooms']);//->middleware('isadministrator');
Route::post('/addroom' , [AdministratorController::class , 'addroom']);//->middleware('isadministrator');
Route::get('/rooms/edit' , [AdministratorController::class , 'showeditroom']);//->middleware('isadministrator');
Route::post('/editroom' , [AdministratorController::class , 'editroom']);//->middleware('isadministrator');
Route::post('/deleteroom' , [AdministratorController::class , 'deleteroom']);//->middleware('isadministrator');



//and this is all what we need for generate materials information
Route::get('/ShowAllmaterials' , [AdministratorController::class , 'ShowAllmaterials']);//->middleware('isadministrator');
Route::post('/addmaterials' , [AdministratorController::class , 'addmaterials']);//->middleware('isadministrator');
Route::get('/materials/{id}/edit' , [AdministratorController::class , 'showeditmaterials']);//->middleware('isadministrator');
Route::post('/editmaterials' , [AdministratorController::class , 'editmaterials']);//->middleware('isadministrator');
Route::post('/deletematerials' , [AdministratorController::class , 'deletematerials']);//->middleware('isadministrator');




//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//this Route for Prsnadministrative
//Route::post('Prsnadministrativelogin', [PrsnadministrativeController::class , 'login'])->middleware('isprsnadministrative');




//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//this Route for Teacher
Route::post('Teacherlogin', [TeacherController::class , 'login']);//->middleware('isteacher');
Route::post('/availablerooms', [TeacherController::class , 'availablerooms']);//->middleware('isteacher');
Route::post('/reservation/add' , [AdministratorController::class , 'addteacher']);//->middleware('isadministrator');
//edit teacher info


Route::post('/addreservation' , [TeacherController::class , 'addreservation']);//->middleware('isadministrator');
Route::post('/updatereservation' , [TeacherController::class , 'updatereservation']);//->middleware('isadministrator');

Route::post('/deletereservation' , [TeacherController::class , 'deletereservation']);//->middleware('isadministrator');
//Route::post('/showreservation' , [TeacherController::class , 'showreservation']);//->middleware('isadministrator');
Route::post('/showroom' , [TeacherController::class , 'showroom']);//->middleware('isadministrator');
Route::post('/reservedRooms' , [TeacherController::class , 'reservedRooms']);//->middleware('isadministrator');


Route::get('returntiming', [TimingController::class , 'returntiming']); //->middleware('isteacher');

//---------------------------------------------------------------------------------------------------------------
//this route for edit profile information
//---------------------------------------------------------------------------------------------------------------
Route::post('showeadmin', [AdministratorController::class, 'showeadmin']); //for show admin profile info
Route::post('editprofileadmin', [AdministratorController::class, 'editprofileadmin']); //for edit admin profile info
Route::post('showeteacher', [TeacherController::class, 'showeteacher']); //for show teacher profile info
Route::post('editprofileteacher', [TeacherController::class, 'editprofileteacher']); //for edit teacher profile info
Route::post('showeprsnadministrative', [PrsnadministrativeController::class, 'showeprsnadministrative']); //for show prsnadministrator profile info
Route::post('editprofileprsnadministrative', [PrsnadministrativeController::class, 'editprofileprsnadministrative']); //for edit prsnadministrator profile info