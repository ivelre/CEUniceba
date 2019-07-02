<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
		/**
     * Menu principal del módulo de administración.
     *
     * @author Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
     * @return view
     */
    public function index(){
    	return view('private.admin.menu');
    }
}
