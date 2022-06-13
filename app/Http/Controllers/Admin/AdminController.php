<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next)
           {

            if (request()->user()->role != 1)
            {
                Auth::logout();
                return redirect('/login');
            }
            return $next($request);
            });

        }
    public function index()
    {
        return view('admin.dashboard');
    }
}
