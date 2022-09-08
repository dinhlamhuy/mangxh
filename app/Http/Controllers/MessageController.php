<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Events\PrivateMessageEvent;
use App\Events\GroupMessageEvent;
use App\Models\MessageGroup;

class MessageController extends Controller
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
    public function conversation($userID){
    
        $user_friends=DB::table('user_messages')
        ->where([
            ['user_messages.sender_id','=', Auth::user()->user_id],
            ['user_messages.receiver_id','<>', null],
        ])
        ->orWhere([
            ['user_messages.sender_id','<>', null],
            ['user_messages.receiver_id','=', Auth::user()->user_id],
        ])
        ->get();
        $datafriends=[];
        foreach ($user_friends as $user_friend){
            if($user_friend->sender_id == Auth::user()->user_id){
                $datafriends[]=$user_friend->receiver_id;
            }
            if($user_friend->receiver_id == Auth::user()->user_id){
                $datafriends[]=$user_friend->sender_id;
            }
        }

        $friends=DB::table('users')
        ->where('users.user_id','<>',Auth::user()->user_id)
        ->whereIn('users.user_id', $datafriends)
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
        $datauser=[];
        foreach ($user_mess as $usr_mess){
            if($usr_mess->sender_id == Auth::user()->user_id){
                $datauser[]=$usr_mess->receiver_id;
            }
            if($usr_mess->receiver_id == Auth::user()->user_id){
                $datauser[]=$usr_mess->sender_id;
            }
        }
     
        $users=DB::table('users')
        ->where('users.user_id','<>',Auth::user()->user_id)
        ->whereIn('users.user_id', $datauser)
        ->get();

        $mess=DB::table('messages')
        ->join('user_messages','user_messages.message_id','=','messages.id')
        ->where([['user_messages.sender_id','=', Auth::user()->user_id],['user_messages.receiver_id','=', $userID]])
        ->orWhere([['user_messages.sender_id','=', $userID],['user_messages.receiver_id','=', Auth::user()->user_id]])
        ->select('*','messages.created_at as ngaynhan','messages.type as theloaifile')
        ->get();

        $friendInfo=User::findOrFail($userID);
        $myInfo=User::find(Auth::user()->user_id);
        $groups=DB::table('message_group_members')
        ->join('message_groups','message_groups.id','=','message_group_members.message_group_id')
        ->join('users','users.user_id','=','message_group_members.user_id')
        ->where('message_group_members.user_id',Auth::user()->user_id)
        ->select('*','message_groups.name as groupname')
        ->get();

        $this->data['users']=$users;
        $this->data['friends']=$friends;
        $this->data['mess']=$mess;
        $this->data['friendInfo']=$friendInfo;
        $this->data['myInfo']=$myInfo;
        $this->data['userID']=$userID;
        $this->data['groups']=$groups;
        return view('message.conversation', $this->data);
    }
    public function sendMessage(Request $request){
        $request->validate([
            'message'   =>  'required',
            'receiver_id'   =>  'required'
        ]);

        $sender_id=Auth::user()->user_id;
        $receiver_id=$request->receiver_id;


    
        $mess='';
        if($request->messtype=='1'){
            $mess =$request->message;
            
        }else if($request->messtype=='2'){
            if ($request->hasFile('messfile')) {
                $completeFileName = $request->file('messfile')->getClientOriginalName();
                $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                $extension = $request->file('messfile')->getClientOriginalExtension();
                $fileNameOnly = str_replace(',', '_', $fileNameOnly);
                $compPic = 'mess'. '_' . rand() . '_' . time() . '.' . $extension;
                $path = $request->file('messfile')->storeAs('/assets/img/mess/', $compPic);
                $img_name = $compPic;
                $mess = $compPic;

            }
        }
        $message= new Message();
        $message->message=$mess;
        $message->type= $request->messtype;




        if($message->save()){
            try {
                $message->users()->attach($sender_id, ['receiver_id' =>  $receiver_id]);
                $sender=User::where('user_id','=',$sender_id)->first();
                $data=[];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender->name;
                $data['receiver_id'] = $receiver_id;
                $data['content'] = $message->message;
                // $data['created_at'] = $message->created_at;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['message_id'] = $message->id;

                event(new PrivateMessageEvent($data));

                return response()->json([
                    'data'  =>  $data,
                    'success'  =>  true,
                    'tenimg'  =>  $mess,
                    'message'  =>  'Message sent successfully',
                ]);

            }catch(\Exception $e){
                $message->delete();
            }
        }
    }

    public function sendGroupMessage(Request $request){
        $request->validate([
            'message'   =>  'required',
            'message_group_id'   =>  'required'
        ]);
        $sender_id=Auth::user()->user_id;
        
        $messageGroupId=$request->message_group_id;

        // $receiver_id=$request->receiver_id;
        $mess='';
        if($request->messtype=='1'){
            $mess =$request->message;
            
        }else if($request->messtype=='2'){
            if ($request->hasFile('messfile')) {
                $completeFileName = $request->file('messfile')->getClientOriginalName();
                $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                $extension = $request->file('messfile')->getClientOriginalExtension();
                $fileNameOnly = str_replace(',', '_', $fileNameOnly);
                $compPic = 'mess'. '_' . rand() . '_' . time() . '.' . $extension;
                $path = $request->file('messfile')->storeAs('/assets/img/mess/', $compPic);
                $img_name = $compPic;
                $mess = $compPic;

            }
        }
        $message= new Message();
        $message->message=$mess;
        $message->type= $request->messtype;
        if($message->save()){
            try {
                $message->users()->attach($sender_id, ['message_group_id' =>  $messageGroupId]);
                $sender=User::where('user_id','=',$sender_id)->first();
                $data=[];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender->name;
                $data['sender_firstname'] = $sender->firstname;
                $data['sender_avatar'] = $sender->avatar;
                $data['content'] = $mess;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;
                $data['group_id'] = $messageGroupId;
                $data['type'] = 2;

                event(new GroupMessageEvent($data));

                return response()->json([
                    'data'  =>  $data,
                    'success'  =>  true,
                    'tenimg'  =>  $mess,
                    'message'  =>  'Message sent successfully',
                ]);

            }catch(\Exception $e){
                $message->delete();
            }
        }
    }

}
