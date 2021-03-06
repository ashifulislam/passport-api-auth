<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Product;
use App\Models\Category;
use Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->where('user_id',Auth::user()->id);
        return view('admin.index',compact('products',$products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin_id = Auth::user()->id;
        $categories = Category::all()->where('user_id',$admin_id);
        return view('admin.create_product',compact('categories',$categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'product_name' => 'required',
            'product_desc' => 'required',
        ]);


        $user_id = Auth::user()->id;
        $products = new Product();
        $products->product_name = $request->input('product_name');
        $products->product_desc = $request->input('product_desc');
        //adding image
        if ($image = $request->file('image')) 
        {
            
            $destinationPath = 'image/';
            //getting extension here
            $profileImage = date('YmdHis') . "." .$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $products->product_image = "$profileImage";
        }
        $products->category_id = $request->input('category_id');
        $products->user_id = $user_id;
        if($products->save())
        {
            Alert::success('Success Title', 'Products added successfully');
            return redirect()->back();
        }
        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return 'This product is going to delete';
    }
    public function search(Request $request)
    {
        $search_keyword = $request->search;
        $products = Product::select("*")
                  ->where('product_name','LIKE',''.$search_keyword.'%')
                  ->where('user_id',Auth::user()->id)
                  ->get();
        return view('admin.index',compact('products',$products));
    }

    public function index_update()
    {
        //load data
        return view('admin.index_update');
    }
    public function getProducts(Request $request)
    {
          ## Read value
          $draw = $request->get('draw');
          $start = $request->get("start");
          $rowperpage = $request->get("length"); // Rows display per page
  
          $columnIndex_arr = $request->get('order');
          $columnName_arr = $request->get('columns');
          $order_arr = $request->get('order');
          $search_arr = $request->get('search');
  
          $columnIndex = $columnIndex_arr[0]['column']; // Column index
          $columnName = $columnName_arr[$columnIndex]['data']; // Column name
          $columnSortOrder = $order_arr[0]['dir']; // asc or desc
          $searchValue = $search_arr['value']; // Search value
  
          // Total records
          $totalRecords = Product::select('count(*) as allcount')->count();
          $totalRecordswithFilter = Product::select('count(*) as allcount')->where('product_name', 'like', '%' .$searchValue . '%')->count();
  
          // Fetch records
          $records = Product::orderBy($columnName,$columnSortOrder)
                 ->where('products.product_name', 'like', '%' .$searchValue . '%')
                ->select('products.*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
  
          $data_arr = array();
  
          foreach($records as $record)
          {
             $id = $record->id;
             $product_name = $record->product_name;
             $desc = $record->product_desc;
  
             $data_arr[] = array(
                 "id" => $id,
                 "product_name" => $product_name,
                 "product_desc" => $desc,
             );
          }
  
          $response = array(
             "draw" => intval($draw),
             "iTotalRecords" => $totalRecords,
             "iTotalDisplayRecords" => $totalRecordswithFilter,
             "aaData" => $data_arr
          );
  
          return response()->json($response); 
       }
    
    }
                

