<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) 
        {
    
            if (request()->user()->role != 2) 
            {
                Auth::logout();
                return redirect('/login');
            }
            return $next($request);
            });
    
        }
    public function index()
    {
        return view('superadmin.index');
    }
}
