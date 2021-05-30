<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use Validator;

class PostController extends Controller
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
        return view("post.post_list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Post::orderBy('id',"DESC")->get();
        return Datatables::of($users)                        
                ->addIndexColumn()
                ->editColumn('url', function($user) {
                    return $user->url;
                })                                               
                ->editColumn('image', function($user) {
                    return '<img src="'.url('/public/post/'.$user->image).'" width="100px">';
                })                                                                      
                ->editColumn('created_at', function($user) {
                    return date("Y-m-d", strtotime($user->created_at));
                })
                ->editColumn('action', function($user) {
                    $html = '<a class="btn btn-info btn-sm" href="'.url('/post/'.$user->id.'/edit').'">Edit</a><button class="btn btn-danger btn-sm delete" id="'.$user->id.'" data-table="post">Delete</button>';                           
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
                        'url' => ['required', 'string'],         
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
            $destinationPath = 'public/post';
            $file_name = time().$file->getClientOriginalName();
            $file->move($destinationPath, $file_name);
            $question['image'] = $file_name;
        } 

        $question['url'] = $input['url'];

        $question_id = Post::create($question);

        return redirect('post')
        ->with(['status' => 'success', 'message' => "Post Added Successfully!!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("post.edit_post",compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [                   
                        'url' => ['required', 'string']    
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
            $destinationPath = 'public/post';
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $file_name);
            $post->image = $file_name;
        }  

        $post->url = $input['url'];             
        $post->save();

        return redirect("post")
               ->with(['status' => 'success', 'message' => "Post Updated Successfully!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['status' => 'success', 'message' => "Post deleted successfully!"]);
    }

    public function addVIew()
    {
        return view('post.add_post');
    }
}
