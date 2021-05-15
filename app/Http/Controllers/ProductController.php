<?php

namespace App\Http\Controllers;

use App\Product;
use App\Network;
use App\Country;
use App\Language;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("product.product_list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Product::orderBy('id',"DESC")->get();
        return Datatables::of($users)                        
                ->addIndexColumn()
                ->editColumn('question', function($user) {
                    return $user->question;
                })
                ->editColumn('start_date', function($user) {
                    return date("Y-m-d", strtotime($user->start_date));
                })
                ->editColumn('end_date', function($user) {
                    return date("Y-m-d", strtotime($user->end_date));
                })                                
                ->editColumn('image', function($user) {
                    return '<img src="'.url('/public/product/'.$user->image).'" width="100px">';
                })                                                                      
                ->editColumn('created_at', function($user) {
                    return date("Y-m-d", strtotime($user->created_at));
                })
                ->editColumn('action', function($user) {
                    $html = '<a class="btn btn-info btn-sm" href="'.url('/product/'.$user->id.'/edit').'">Edit</a><button class="btn btn-danger btn-sm delete" id="'.$user->id.'" data-table="product">Delete</button>';                           
                    return $html;                            
                })->rawColumns(['action', 'image'])->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $network = Network::all();
        $language = Language::all();
        $country = Country::all();
        return view("product.edit_product",compact('product','network','language','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       $validator = Validator::make($request->all(), [                   
                        'name' => 'required|max:200',                                                        
                        'email' => 'required|max:200',                                                        
                        'image' => 'nullable|mimes:jpeg,jpg,png,gif',
                        'cost'=> 'required',
                        'mobile'=> 'required',
                        'product_id'=> 'required',                        
                        'network_id'=> 'required',                        
                        'country_id'=> 'required',                        
                        'language_id'=> 'required',                        
                        'promotional_link'=> 'required',                        
                        'post_type'=> 'required',                        
                        'captcha'=> 'required|max:200',                        
                    ]);
        

        if ($validator->fails()) {
            $errors = json_decode($validator->errors());
            foreach ($errors as $key => $value) {
                return redirect()->back()->with(['status' => 'error', 'error_message' => $value[0]])
                                 ->withInput($request->all());        
            }
        }
                
        $input = $request->all();

        if ($request->has('image')) {
            $file = $request->file('image');
            $destinationPath = 'public/product';
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $file_name);
            $product->image = $file_name;
        }  

        $product->name = $input['name'];
        $product->cost = $input['cost'];
        $product->email = $input['email'];        
        $product->mobile = $input['mobile'];        
        $product->product_id = $input['product_id'];   
        $product->network_id = $input['network_id'];   
        $product->country_id = $input['country_id'];   
        $product->language_id = $input['language_id'];   
        $product->promotional_link = $input['promotional_link'];   
        $product->post_type = $input['post_type'];   
        $product->company_name = $input['captcha'];   
        //echo "<pre>"; print_r($product); die();

        $product->save();

        return redirect("product")
               ->with(['status' => 'success', 'message' => "Product updated successfully!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['status' => 'success', 'message' => "Product deleted successfully!"]);
    }

    public function addProduct()
    {
        return view('product.add_product');
    }
}
