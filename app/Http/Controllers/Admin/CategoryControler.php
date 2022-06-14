<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;
use Auth;

class CategoryControler extends Controller
{
    public function addCategory()
    {
        return view('admin.category');

    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name' => 'required',
            'category_desc' => 'required',
        ]);

        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->category_desc = $request->input('category_desc');
        $category->user_id = Auth::user()->id;
        if($category->save())
        {
            Alert::success('Success Title', 'Category added successfully');
            return redirect()->back();


        }





    }
}
