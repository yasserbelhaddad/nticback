<?php

namespace App\Http\Controllers;

use App\Models\Prsnadministrative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrsnadministrativeController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password, 'role'=>'prsnadministrative']))
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
}
