<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiLoginController extends Controller
{
    public function login (Request $request){
        $usuario = Usuario::where('email',$request->email)->first();
        if($usuario){
            if(password_verify($request -> password,$usuario -> password)){                
                return response()->json($usuario, 200);
            }else{
                return response()->json('Tus credenciales son incorrectas. Favor de revisarlas e intente de nuevo.', 442);
            }
        }else{
            return response()->json('Usuario no registrado.', 442);
        }
    }
}
