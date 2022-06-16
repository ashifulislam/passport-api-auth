<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
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
             $product_image = $record->product_image;
  
             $data_arr[] = array(
                 "id" => $id,
                 "product_name" => $product_name,
                 "product_desc" => $desc,
                 "product_image" => $product_image,
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
