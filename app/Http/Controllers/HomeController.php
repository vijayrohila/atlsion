<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Setting;
use App\Product;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function contentView()
    {
        $this->authorize('isAdmin');
        
        $setting = Setting::all();
        $settings = array();
        foreach ($setting as $key => $value) {
            $settings[$value->key] = $value->value;
        }
        //echo "<pre>"; print_r($settings); die();
        return view("content.content",compact('settings'));
    }

    public function contentAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [                    
                        'drow_count'=> 'required',
                        'drow_price'=> 'required',
                        //'company_name'=> 'required|string|max:255',
                        //'image1'=> 'mimes:jpeg,jpg,png,gif',
                        //'image2'=> 'mimes:jpeg,jpg,png,gif',
                        //'image3'=> 'mimes:jpeg,jpg,png,gif',
                        'contact_us'=> 'required|string|max:255000',
                        'about_us'=> 'required|string|max:255000',
                        'term_condition'=> 'required|string|max:255000',
                        'privacy_policy'=> 'required|string|max:255000',
                    ]);

        if ($validator->fails()) {
            $errors = json_decode($validator->errors());
            foreach ($errors as $key => $value) {
                return redirect()->back()->with(['status' => 'error', 'message' => $value[0]]);      
            }
        }    

        $input = $request->all();


        $insert = array(
                    array(
                        "key"=>"about_us",
                        "value"=>$request->about_us,
                    ),array(
                        "key"=>"contact_us",
                        "value"=>$request->contact_us,
                    ),array(
                        "key"=>"term_condition",
                        "value"=>$request->term_condition,
                    ),array(
                        "key"=>"privacy_policy",
                        "value"=>$request->privacy_policy,
                    ),array(
                        "key"=>"drow_count",
                        "value"=>$request->drow_count,
                    ),array(
                        "key"=>"drow_price",
                        "value"=>$request->drow_price,
                    )
                        
        );

        //echo "<pre>"; print_r($input); die();

        if ($request->has('image1')) {
            $file = $request->file('image1');
            $destinationPath = 'public/banner';
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $file_name);

            $insert[] = array(
                                "key"  => "banner1",
                                "value" => $file_name,   
                            );
            
        }

        if ($request->has('image2')) {
            $file = $request->file('image2');
            $destinationPath = 'public/banner';
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $file_name);
            $insert[] = array(
                                "key"  => "banner2",
                                "value" => $file_name,   
                            );
        }

        if ($request->has('image3')) {
            $file = $request->file('image3');
            $destinationPath = 'public/banner';
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $file_name);
            $insert[] = array(
                                "key"  => "banner3",
                                "value" => $file_name,   
                            );
        } 

        Setting::whereIn("key",array_column($insert, "key"))->delete();

        Setting::insert($insert);

        return redirect("content")
               ->with(['status' => 'success', 'message' => "Content Updated Scussesfully!"]);
        
    }

     

    
}
