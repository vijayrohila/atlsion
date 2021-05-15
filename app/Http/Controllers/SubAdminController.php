<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use yajra\Datatables\Datatables;
use Validator;
use Illuminate\Validation\Rule;
use Hash;

class SubAdminController extends Controller
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
        return view("subadmin.user_list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where("role","subadmin")->orderBy('id',"DESC")->get();
        return Datatables::of($users)                        
                ->addIndexColumn()
                ->editColumn('name', function($user) {
                    return $user->name;
                })
                ->editColumn('email', function($user) {
                    return $user->email;
                }) 
                ->editColumn('mobile', function($user) {
                    return $user->mobile;
                })                                                                                    
                ->editColumn('created_at', function($user) {
                    return date("Y-m-d", strtotime($user->created_at));
                })
                ->editColumn('action', function($user) {
                    $html = '<a class="btn btn-info btn-sm" href="'.url('/sub-admin/'.$user->id.'/edit').'">Edit</a><button class="btn btn-danger btn-sm delete" id="'.$user->id.'" data-table="sub-admin">Delete</button><a class="btn btn-info btn-sm" href="'.route('sub.admin.cp',$user->id).'">Change Password</a>';                           
                    return $html;                            
                })->rawColumns(['action'])->make(true);
    }

    public function AddSubAdmin(Request $request)
    {
        return view("subadmin.add_user");
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
                        'password' => ['required', 'string', 'min:8', 'confirmed'],         
                        'email' => ['required', 'string', 'max:150','unique:users'] ,       
                        'name' => ['required', 'string', 'max:150'],        
                        'mobile' => ['required',  'max:100']        
                    ]);

        if ($validator->fails()) {
            $errors = json_decode($validator->errors());
            foreach ($errors as $key => $value) {
                return redirect()->back()->with(['status' => 'error', 'error_message' => $value[0]])
                        ->withInput($request->all());        
            }
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return redirect('sub-admin')->with(['status' => 'success', 'message' => "SubAdmin Added Successfully!!"]);

    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subadmin = User::find($id);
        return view("subadmin.edit_user",compact('subadmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [                   
                        'name' => 'required|max:150|string',                                                        
                        'mobile' => 'required|max:100',                                                        
                        'email' => 'required|max:150|string|'.Rule::unique('users')->ignore($id),                                                       
                    ]);
        

        if ($validator->fails()) {
            $errors = json_decode($validator->errors());
            foreach ($errors as $key => $value) {
                return redirect()->back()->with(['status' => 'error', 'error_message' => $value[0]])
                                 ->withInput($request->all());        
            }
        }
                
        $input = $request->all();

        $user = User::find($id);
        $user->name = $input['name'];
        $user->email = $input['email'];       
        $user->mobile = $input['mobile'];       
        $user->save();

        return redirect("sub-admin")
               ->with(['status' => 'success', 'message' => "SubAdmin Updated Successfully!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['status' => 'success', 'message' => "SubAdmin Deleted Successfully!"]);
    }

    public function changePassword($id)
    {
        return view('subadmin.sub_admin_cp',compact('id'));   
    }

    public function updatePassword(Request $request,$id)
    {
        $validatedData = $request->validate([
            'password' => 'required|confirmed|min:8',            
        ]);
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();   

        return redirect()->back()
        ->with(['status' => 'success', 'message' => "SubAdmin Change Password Successfully!"]);   
    }
}
