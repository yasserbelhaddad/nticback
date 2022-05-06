<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Material;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password, 'role'=>'Administrator']))
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
//generate teachers information
//---------------------------------------------------------------------------------------------------------------
    public function ShowAllTeachers()
    {
        return response()->json(DB::table('teachers')
        ->select('firstname', 'lastname', 'email', 'phonenumber', 'department','grade','status','state')
        ->orderBy('department')->get());
    }
    
//---------------------------------------------------------------------------------------------------------------
    public function addteacher(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phonenumber' => 'required',
                'department' => 'required',
                'grade' => 'required',
                'status' => 'required',
                'state' => 'required',
                'password' => 'required|min:8'
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            //add teacher in Teachers table
            $teacher = new Teacher();
            $teacher->firstname = $request->input('firstname');
            $teacher->lastname = $request->input('lastname');
            $teacher->email = $request->input('email');
            $teacher->phonenumber = $request->input('phonenumber');
            $teacher->department = $request->input('department');
            $teacher->grade = $request->input('grade');
            $teacher->status = $request->input('status');
            $teacher->state = $request->input('state');
                    $password = $request->input('password');
            $teacher->password = Hash::make($password);
            $teacher->save();

            //add teacher in Users table
            $user = new User();
            $user->name = $request->input('firstname');
            $user->email = $request->input('email');
                    $password = $request->input('password');
            $user->password = Hash::make($password);
            $user->role = 'Teacher';
            $user->status = $request->input('status');
            $user->save();
            return redirect()->back()->with('status','Teacher Added Successfully');
        }       
    }
//---------------------------------------------------------------------------------------------------------------

    public function showeditteacher($email){
        //$teacher = User::find($id);

        return response()->json(Teacher::where('email' , $email)->first());
    }
//---------------------------------------------------------------------------------------------------------------
    public function editteacher(Request $request, $email)
    {
        $validator = Validator::make($request->all(),
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phonenumber' => 'required',
                'department' => 'required',
                'grade' => 'required',
                'status' => 'required',
                'state' => 'required',
                'password' => 'required|min:8'
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            //$teacher = Teacher::where('email' , $email)->first();
            $teacher = Teacher::whereEmail($email)->first();
            $user = User::where('email' , $email)->first();
            $teacher->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phonenumber' => $request->phonenumber,
                'department' => $request->department,
                'grade' => $request->grade,
                'status' => $request->status,
                'state' => $request->state,
                        //$password => $request->password,
                'password' => Hash::make($request->password),
            ]);
            $user->update([
                'name' => $request->firstname,
                'status' => $request->status,
                        //$password => $request->password,
                'password' => Hash::make($request->password),
        ]);
                return response()->json('update succesfully');
        }
        
        
        
    }


    /*public function Editteacher(Request $request){
    
        $Consultation = consultation::where('id',$Validate['id']);
        $Consultation->update([
            $teacher=


²
            'motive' => $Validate['Reason'],
            'detail' => $Validate['Detail'],
            'examination' => $Validate['Examination'],
            'treatment' => $Validate['Treatment'],
            'type' => $Validate['Type'],
        ]);

        $Response = [
            'message' => 'success',
        ];
        return response($Response,201);

        $validator = Validator::make($request->all(),
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phonenumber' => 'required',
                'department' => 'required',
                'grade' => 'required',
                'status' => 'required',
                'state' => 'required',
                'password' => 'required|min:8'
            ]
        );
    }*/
//---------------------------------------------------------------------------------------------------------------
    public function deleteteacher($email)
    {   
        //$user = DB::select('select email from teachers where id = ?' , [$id]);
        //$teacheremail = Teacher::find($email);
        //$users = DB::select('select id from users where email = ?' , [$email]);
        //$userid = User::where('id', $users);
        $user = DB::table('users')->where('email' , $email)->delete();
        $teacherd = Teacher::find($email);
        $teacherd->delete();
        //$users = User::find($email);
        //$users->delete();
        
        return redirect()->back()->with('status','Student Deleted Successfully');
    }
//---------------------------------------------------------------------------------------------------------------
//generate rooms information
//---------------------------------------------------------------------------------------------------------------
    public function ShowAllRooms()
    {
        return response()->json(Room::orderBy('floor')->get());
    }
//---------------------------------------------------------------------------------------------------------------

    public function addroom(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'roomname' => 'required',
                'capacity' => 'required',
                'floor' => 'required',
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        Room::create([
            'roomname'=>$request->roomname,
            'capacity'=>$request->capacity,
            'floor'=>$request->floor,
        ]);
        return response()->json('succefully added');
    }
//---------------------------------------------------------------------------------------------------------------
    public function showeditroom($roomname)
    {
        return response()->json(Room::where('roomname' , $roomname)->first());
    }
//---------------------------------------------------------------------------------------------------------------
    public function editroom(Request $request, $roomname)
    {
        $validator = Validator::make($request->all(),
        [
            'roomname' => 'required',
            'capacity' => 'required',
            'floor' => 'required',
        ]
    );
    if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
    }
            $room = Room::whereRoomname($roomname)->first();
            $room->update([
                'roomname' => $request->roomname,
                'capacity' => $request->capacity,
                'floor' => $request->floor,
        ]);
    }
//---------------------------------------------------------------------------------------------------------------
    public function deleteroom($roomname)
    {   
        $room = Room::find($roomname);
        $room->delete();  
        return redirect()->back()->with('status','room Deleted Successfully');
    }
//---------------------------------------------------------------------------------------------------------------
//generate materials information
//---------------------------------------------------------------------------------------------------------------
public function ShowAllmaterials()
{
    return response()->json(Material::orderBy('typematerial')->get());
}
//---------------------------------------------------------------------------------------------------------------

public function addmaterials(Request $request)
{
    $validator = Validator::make($request->all(),
        [
            'state' => 'required',
            'serialnumber' => 'required',
            'property' => 'required',
            'typematerial' => 'required',
        ]
    );
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    Material::create([
        'state'=>$request->state,
        'serialnumber'=>$request->serialnumber,
        'property'=>$request->property,
        'typematerial'=>$request->typematerial,
    ]);
    return response()->json('succefully added');
}
//---------------------------------------------------------------------------------------------------------------
public function showeditmaterials($id)
{
    return response()->json(Material::where('id' , $id)->first());
}
//---------------------------------------------------------------------------------------------------------------
public function editmaterials(Request $request, $id)
{
    $validator = Validator::make($request->all(),
    [
        'state' => 'required',
        'serialnumber' => 'required',
        'property' => 'required',
        'typematerial' => 'required',
    ]
);
if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
}
        $material = Material::whereId($id)->first();
        $material->update([
            'state' => $request->state,
            'serialnumber' => $request->serialnumber,
            'property' => $request->property,
            'typematerial' => $request->typematerial,
    ]);
}
//---------------------------------------------------------------------------------------------------------------
public function deletematerials($id)
{   
    $material = Material::find($id);
    $material->delete();  
    return redirect()->back()->with('status','material Deleted Successfully');
}
//---------------------------------------------------------------------------------------------------------------
//this is about consultation
//---------------------------------------------------------------------------------------------------------------


    public function showreservation()
    {
        $reservation = Reservation::all();
        return response()->json(Reservation::orderBy('reservationdate')->get());
    }

    
    




}
