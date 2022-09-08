<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
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
        

        $friend=DB::table('friend')
        ->where([
            ['friend.user_from','=', Auth::user()->user_id],
            ['friend.user_to','<>', null],
        ])
        ->orWhere([
            ['friend.user_from','<>', null],
            ['friend.user_to','=', Auth::user()->user_id],
        ])->get();
        $datafri=[];
        foreach ($friend as $fri){
            if($fri->user_from == Auth::user()->user_id){
                $datafri[]=$fri->user_to;
            }
            if($fri->user_to == Auth::user()->user_id){
                $datafri[]=$fri->user_from;
            }
        }
        $friends=DB::table('users')
        ->whereIn('user_id', $datafri)
        ->get();


        $user_mess=DB::table('user_messages')
        ->where([
            ['user_messages.sender_id','=', Auth::user()->user_id],
            ['user_messages.receiver_id','<>', null],
        ])
        ->orWhere([
            ['user_messages.sender_id','<>', null],
            ['user_messages.receiver_id','=', Auth::user()->user_id],
        ])
        ->get();
        $data=[];
        foreach ($user_mess as $usr_mess){
            if($usr_mess->sender_id == Auth::user()->user_id){
                $data[]=$usr_mess->receiver_id;
            }
            if($usr_mess->receiver_id == Auth::user()->user_id){
                $data[]=$usr_mess->sender_id;
            }
        }
        $users=DB::table('users')
        ->whereIn('user_id', $data)
        ->get();
        $groups=DB::table('message_group_members')
        ->join('message_groups','message_groups.id','=','message_group_members.message_group_id')
        ->join('users','users.user_id','=','message_group_members.user_id')
        ->where('message_group_members.user_id',Auth::user()->user_id)
        ->select('*','message_groups.name as groupname')
        ->get();

        $mess=DB::table('messages')
        ->join('user_messages','user_messages.message_id','=','messages.id')
        ->where('user_messages.sender_id','=', Auth::user()->user_id)
        ->orWhere('user_messages.receiver_id','=', Auth::user()->user_id)
        ->get();


        return view('chat', compact('users','user_mess','data','groups','friends'));
    }

    public function search_chat(Request $request){
        // $request->search;
        $friend=DB::table('friend')
        ->where([
            ['friend.user_from','=', Auth::user()->user_id],
            ['friend.user_to','<>', null],
        ])
        ->orWhere([
            ['friend.user_from','<>', null],
            ['friend.user_to','=', Auth::user()->user_id],
        ])->get();
        $datafri=[];
        foreach ($friend as $fri){
            if($fri->user_from == Auth::user()->user_id){
                $datafri[]=$fri->user_to;
            }
            if($fri->user_to == Auth::user()->user_id){
                $datafri[]=$fri->user_from;
            }
        }
        $friends=DB::table('users')
        ->whereIn('user_id', $datafri)
        ->where('name','like','%'.$request->search.'%')
        ->orWhere('firstname','like','%'.$request->search.'%')
        ->whereIn('user_id', $datafri)
        ->orWhere('email','like','%'.$request->search.'%')
        ->whereIn('user_id', $datafri)
        ->get();
        $ouput='';
        foreach ($friends as $fr){        
            $ouput.='<li class="list-group-item">';
            $ouput.='<a href="'. url('conversation/'.$fr->user_id).'">';
            $ouput.='<img src="storage/app/assets/img/avatar/'.$fr->avatar.'" class="lishfriend"> &ensp;';
            $ouput.='<span class="text-muted h6">'.$fr->firstname.' '.$fr->name.'</span></a></li>';
        }
        return response()->json([
           'data'   =>    $ouput
        ]);
    }
}
