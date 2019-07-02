<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    /**
     * Revisa sí el usuario esta logueado de lo contrario envia al form login
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return redirect
     */
    public function showLoginForm()
    {
        if(\Session::has('usuario')){
            return redirect(route('admin.menu'));
        }
        return view('public.auth.login');
    }
    
    /**
     * Valida las credenciales del usuario.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @param  \Illuminate\Http\Request     $request    - Credenciales del Usuario
     * @return redirect
     */
    public function login(Request $request)
    {
        $usuario = Usuario::where('email',$request->email)->first();
        if($usuario){
            if(password_verify($request -> password,$usuario -> password)){
                \Session::put('usuario', $usuario);
                return redirect(route('admin.menu'));
            }else{
                \Session::flash('msg','Tus credenciales son incorrectas. Favor de revisarlas e intente de nuevo.');        
            }
        }else{
            \Session::flash('msg','Usuario no registrado');    
        }
        return redirect(route('login'));
    }

    /**
     * Cerrar la sesión del usuario.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return redirect
     */
    public function logout()
    {
        \Session::flush();
            \Session::flash('msg','Has terminado tu sesión.');
            return redirect('login');
    }
    
}
