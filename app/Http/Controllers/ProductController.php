<?php

namespace App\Http\Controllers;

use App\Product;
use App\Network;
use App\Country;
use App\Language;
use App\Product_option;
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
        $validator = Validator::make($request->all(), [                   
                        'question' => ['required', 'string'],         
                        'start' => ['required'] ,       
                        'end' => ['required'],        
                        'image' => ['required']        
                    ]);

        if ($validator->fails()) {
            $errors = json_decode($validator->errors());
            foreach ($errors as $key => $value) {
                return redirect()->back()->with(['status' => 'error', 'error_message' => $value[0]])
                        ->withInput($request->all());        
            }
        }

        $input = $request->all();

        $question = [];

        if ($request->has('image')) {
            $file = $request->file('image');
            $destinationPath = 'public/product';
            $file_name = time().$file->getClientOriginalName();
            $file->move($destinationPath, $file_name);
            $question['image'] = $file_name;
        } 

        $question['question'] = $input['question'];
        $question['start_date'] = $input['start'];
        $question['end_date'] = $input['end'];   
        $question['created_at'] = date("Y-m-d h:i:s");   
        $question['updated_at'] = date("Y-m-d h:i:s"); 

        $question_id = Product::create($question);

        //print_r($question_id); die();

        $option = [];

        foreach ($input['select'] as $key => $slt) {
            $option[] = array(
                            "product_id" => $question_id->id,
                            "option" => $slt['option'],
                            "answer" => $slt['answer'],
                            'created_at' => date("Y-m-d h:i:s"),
                            'updated_at' => date("Y-m-d h:i:s"),
                        );
        }

        //echo "<pre>"; print_r($option); die();
        
        Product_option::insert($option);

        $ans = Product_option::where(["product_id" => $question_id->id,"answer"=>"1"])->get()->first();

        $question_id->answer = $ans->id;

        $question_id->save();

        return redirect('product')
        ->with(['status' => 'success', 'message' => "Question Added Successfully!!"]);
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
         
        return view("product.edit_product",compact('product'));
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
                        'question' => ['required', 'string'],         
                        'start' => ['required'] ,       
                        'end' => ['required'],                       
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

        $product->question = $input['question'];
        $product->start_date = $input['start'];
        $product->end_date = $input['end'];      
        //$product->save();


        $option = [];

        foreach ($input['select'] as $key => $slt) {
            $option[] = array(
                            "product_id" => $product->id,
                            "option" => $slt['option'],
                            "answer" => $slt['answer'],
                            'created_at' => date("Y-m-d h:i:s"),
                            'updated_at' => date("Y-m-d h:i:s"),
                        );
        }

        Product_option::where(["product_id" => $product->id])->delete();
        Product_option::insert($option);

        $ans = Product_option::where(["product_id" => $product->id,"answer"=>"1"])->get()->first();

        $product->answer = $ans->id;

        $product->save();

        return redirect("product")
               ->with(['status' => 'success', 'message' => "Question updated successfully!"]);
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
