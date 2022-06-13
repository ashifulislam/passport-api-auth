<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) 
        {
    
            if (request()->user()->role != 3) 
            {
                Auth::logout();
                return redirect('/login');
            }
            return $next($request);
            });
    
        }
    public function index()
    {
        return view('customer.index');
    }
}
