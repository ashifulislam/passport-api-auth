<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryControler extends Controller
{
    public function addCategory()
    {
        return view('admin.category');
    }
}
