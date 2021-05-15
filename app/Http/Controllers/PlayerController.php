<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('player.player_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Player::orderBy('id',"DESC")->get();
        return Datatables::of($users)                        
                ->addIndexColumn()
                ->editColumn('mobile', function($user) {
                    return $user->mobile;
                })
                ->editColumn('pay_through', function($user) {
                    return $user->pay_through;
                })
                ->editColumn('score', function($user) {
                    $total = $user->correct+$user->wrong;
                    return $user->correct.'/'.$total ;
                })                                
                                                                                     
                ->editColumn('created_at', function($user) {
                    return date("Y-m-d", strtotime($user->created_at));
                })
                ->editColumn('action', function($user) {
                    $html = '<button class="btn btn-danger btn-sm delete" id="'.$user->id.'" data-table="product">Delete</button>';                           
                    return $html;                            
                })->rawColumns(['action', 'image'])->make(true);
    }

    public function winnerList()
    {
        $users = Player::where("status","win")->orderBy('id',"DESC")->get();
        return Datatables::of($users)                        
                ->addIndexColumn()
                ->editColumn('mobile', function($user) {
                    return $user->mobile;
                })
                ->editColumn('pay_through', function($user) {
                    return $user->pay_through;
                })
                ->editColumn('score', function($user) {
                    $total = $user->correct+$user->wrong;
                    return $user->correct.'/'.$total ;
                })                                
                ->editColumn('created_at', function($user) {
                    return date("Y-m-d", strtotime($user->created_at));
                })
                ->editColumn('action', function($user) {
                    $html = '<button class="btn btn-danger btn-sm delete" id="'.$user->id.'" data-table="product">Delete</button>';                           
                    return $html;                            
                })->rawColumns(['action', 'image'])->make(true);
    }

    public function winner()
    {
        return view("player.winner-list");
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
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //
    }
}
