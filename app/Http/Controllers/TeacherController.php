<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{

        public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password, 'role'=>'teacher']))
        {
            $user = auth()->user();
            $token = $user->createToken('token');
            return $token->plainTextToken;
        }

        return response()->json([
            "succes"=>false,
            "status"=>200
        ]);
    }
//---------------------------------------------------------------------------------------------------------------
        public function logout (Request $request) {
            $request->user()->currentAccessToken()->delete();
            return response(['message' => 'You have been successfully logged out.'], 200);
    }
//---------------------------------------------------------------------------------------------------------------
//this is about consultation
//---------------------------------------------------------------------------------------------------------------

        public function availablerooms(Request $request)
    {
        //$rooms = DB::table('rooms')->select('username', 'firstname')
        //->whereNotIn('id', function($query) 
        //{ $query->table('course_enroles')->select('user_id')->where('course_id', '=', 1); })->get();
        //$roomsreserv = DB::table('reserveation')->select('roomname')
        //->where('reservationdate', '=' ,$request->input('reservationdate'))
        //$rooms = DB::table('rooms')
            //->whereNotIn('roomname',->and)
            //->get();
        //$rooms = DB::select("select * from rooms where roomname not in (select roomname from reservation where 'reservationdate' = $request->input('reservationdate')");
        $start = $request->input('starttime');
        $end =  $request->input('endtime');

        $reserveroom = Reservation::select('room_id')->where('reservationdate',$request->input('reservationdate'))
        /*->whereIn('roomtiming', [$start,$end])*/->where('roomtiming','>=',$start)->where('roomtiming','<',$end)->get();
        //->select('roomname')->where('roomname', '=', 'amphi1')->first();
        $rooms = Room::select('roomname','capacity','floor')->whereNotIn('id',$reserveroom)->get();

        return response()->json($rooms);


    }


        public function addreservation(Request $request)
    {
        
    }

        public function updatereservation(Request $request, $id)
    {
            $reservation = Reservation::find($id);
            $reservation->name = $request->input('name');
            $reservation->email = $request->input('email');
            $reservation->course = $request->input('course');
            $reservation->section = $request->input('section');
            $reservation->update();
            return redirect()->back()->with('status','Student Updated Successfully');
    }

        public function deletereservation($id)
    {
            $reservation = Reservation::find($id);
            $reservation->delete();
            return redirect()->back()->with('status','Student Deleted Successfully');
    }


    
}
