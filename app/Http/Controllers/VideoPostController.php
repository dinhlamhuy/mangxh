<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\FilePost;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;

class VideoPostController extends Controller
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
    public function index(){

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

        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();

        $baidang = DB::table('posts')
            ->leftJoin('group', 'group.group_id', '=', 'posts.group_id')
            ->leftJoin('school', 'school.school_id', '=', 'posts.school_id')
            ->join('users', 'users.user_id', '=', 'posts.user_id')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('users.*', 'posts.*', 'posts.created_at as ngaydang', 'group.*', 'school.*', 'school.school_id as idschool')
            ->orderBy('posts.post_id', 'DESC')
            ->where('file_post.img_type','LIKE','%video%')
            // ->where('posts.type_post','=','1')
            ->where('post_choduyet', '=', '1')
            ->where('posts.status', '=', 'Công khai')
            ->get();


            
        // $baidang = DB::table('posts')
        // ->leftJoin('group', 'group.group_id', '=', 'posts.group_id')
        // ->leftJoin('school', 'school.school_id', '=', 'posts.school_id')
        // ->join('users', 'users.user_id', '=', 'posts.user_id')
        // ->select('users.*', 'posts.*', 'posts.created_at as ngaydang', 'group.*', 'school.*', 'school.school_id as idschool')
        // ->orderBy('post_id', 'DESC')
        // // ->where('posts.category_post', '<>', '2')
        // ->where('post_choduyet', '=', '1')
        // ->where('posts.status', '=', 'Công khai')
        // ->get();

        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            // ->where('file_post.img_type','LIKE','%.mp4%')
            ->where('posts.status', '=', 'Công khai')
            ->get();

      
        $slicon = DB::table('emoticons')
            ->select(DB::raw('count(*) as bieucam, post_id', 'emoticons_symbol'))
            ->groupBy('post_id')
            ->get();

        $groups = DB::table('message_group_members')
            ->join('message_groups', 'message_groups.id', '=', 'message_group_members.message_group_id')
            ->join('users', 'users.user_id', '=', 'message_group_members.user_id')
            ->where('message_group_members.user_id', Auth::user()->user_id)
            ->select('*', 'message_groups.name as groupname')
            ->get();
            $icon = DB::table('icon')->get();
            $emoticons = DB::table('emoticons')
            ->join('icon','icon.icon_id','=','emoticons.icon_id')
            ->get();
            $slicon = DB::table('emoticons')
            ->join('icon','icon.icon_id','=','emoticons.icon_id')
                ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
                ->groupBy('post_id')
                ->get();

        return view('watch', compact('baidang', 'emoticons', 'slicon', 'friends', 'groups','imgbaidang','icon'));

    }
}
