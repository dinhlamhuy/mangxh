<?php

namespace App\Http\Controllers;

use App\Models\MessageGroup;
use App\Models\MessageGroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MessageGroupController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['user_id'] = Auth::user()->user_id;
        $messageGroup = MessageGroup::create($data);
        if ($messageGroup) {
            $memberData['user_id'] = Auth::user()->user_id;
            $memberData['message_group_id'] = $messageGroup->id;
            $memberData['status'] = 1;
            MessageGroupMember::create($memberData);
            if (isset($request->user_id) && !empty($request->user_id)) {
                foreach ($request->user_id as $userId) {
                    $memberData['user_id'] = $userId;
                    $memberData['message_group_id'] = $messageGroup->id;
                    $memberData['status'] = 1;

                    MessageGroupMember::create($memberData);
                }
            }
        }
        return back();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user_friends = DB::table('friend')
        ->where([
            ['friend.user_from', '=', Auth::user()->user_id],
            ['friend.user_to', '<>', null],
        ])
        ->orWhere([
            ['friend.user_from', '<>', null],
            ['friend.user_to', '=', Auth::user()->user_id],
        ])
        ->get();
    $datafriends = [];
    foreach ($user_friends as $user_friend) {
        if ($user_friend->user_from == Auth::user()->user_id) {
            $datafriends[] = $user_friend->user_to;
        }
        if ($user_friend->user_to == Auth::user()->user_id) {
            $datafriends[] = $user_friend->user_from;
        }
    }


        $user_mess = DB::table('user_messages')
            ->where([
                ['user_messages.sender_id', '=', Auth::user()->user_id],
                ['user_messages.receiver_id', '<>', null],
            ])
            ->orWhere([
                ['user_messages.sender_id', '<>', null],
                ['user_messages.receiver_id', '=', Auth::user()->user_id],
            ])
            ->get();
        $datausr = [];
        foreach ($user_mess as $usr_mess) {
            if ($usr_mess->sender_id == Auth::user()->user_id) {
                $datausr[] = $usr_mess->receiver_id;
            }
            if ($usr_mess->receiver_id == Auth::user()->user_id) {
                $datausr[] = $usr_mess->sender_id;
            }
        }



        $users = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datausr)
            ->get();
        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();
        // $friendInfo=User::findOrFail($userID);
        $myInfo = User::find(Auth::user()->user_id);
        $groups = DB::table('message_group_members')
            ->join('message_groups', 'message_groups.id', '=', 'message_group_members.message_group_id')
            ->join('users', 'users.user_id', '=', 'message_group_members.user_id')
            ->where('message_group_members.user_id', Auth::user()->user_id)
            ->select('*', 'message_groups.name as groupname')
            ->get();
        // MessageGroup::where('message_group_members.user_id',Auth::user()->user_id)->get();
        $currentGroup = MessageGroup::where('id', $id)
            ->with('message_group_members.user')
            ->first();

        $mess = DB::table('messages')
            ->join('user_messages', 'user_messages.message_id', '=', 'messages.id')
            ->join('users', 'users.user_id', '=', 'user_messages.sender_id')
            ->where('user_messages.message_group_id', '=', $id)
            ->select('*', 'messages.created_at as ngaynhan', 'messages.type as theloaifile')
            ->get();
        // $currentMembers

        $this->data['users'] = $users;
        $this->data['mess'] = $mess;
        $this->data['myInfo'] = $myInfo;
        $this->data['groups'] = $groups;
        $this->data['currentGroup'] = $currentGroup;

        return view('message_groups.index', compact('users', 'mess', 'myInfo', 'groups', 'currentGroup','friends'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
        if (isset($request->user_id) && !empty($request->user_id)) {
            foreach ($request->user_id as $userId) {
                $memberData['user_id'] = $userId;
                $memberData['message_group_id'] = $id;
                $memberData['status'] = 1;

                MessageGroupMember::create($memberData);
            }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
