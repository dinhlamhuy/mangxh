<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

session_start();

class Admin2Controller extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('ad_ma');
        if ($admin_id) {
            return Redirect::to('admin/dashboard');
        } else {
            return Redirect::to('admin/login')->send();
        }
    }
    public function deletepost(Request $request)
    {
        $this->AuthLogin();
        $delete = DB::table('posts')
            ->where('posts.post_id', '=', $request->post_id)
            // ->orwhere('posts.sharepost_id', '=', $request->post_id)
            ->delete();
        $delete = DB::table('file_post')
            ->where('file_post.post_id', '=', $request->post_id)
            ->delete();
        $delete = DB::table('baocaopost')
            ->where('baocaopost.post_id', '=', $request->post_id)
            ->delete();
        $delete = DB::table('comment')
            ->where('comment.post_id', '=', $request->post_id)
            ->delete();
        $delete = DB::table('emoticons')
            ->where('emoticons.post_id', '=', $request->post_id)
            ->delete();
        $delete = DB::table('bookmark')
            ->where('bookmark.baiviet', '=', $request->post_id)
            ->delete();
        return response()->json([
            'mess' =>   'Xóa thành công',
        ]);
    }
    public function deleteuser(Request $request)
    {
        $this->AuthLogin();
        $xoa=DB::table('message_groups')->where('user_id', '=', $request->user_id)->delete();
        $xoa=DB::table('message_group_members')->where('user_id', '=', $request->user_id)->delete();
        $xoa=DB::table('group')->where('group_founder', '=', $request->user_id)->delete();
        $xoa=DB::table('group_work')->where('nguoitao_id', '=', $request->user_id)->delete();
        $xoa=DB::table('group_members')->where('user_id', '=', $request->user_id)->delete();
        $mess=DB::table('user_messages')
        ->where('sender_id','=',$request->user_id)
        ->orwhere('receiver_id','=',$request->user_id)
        ->get();
        foreach($mess as $xmes){
            $delete = DB::table('messages')
            ->where('messages.id', '=', $xmes->message_id)
            ->delete();
        }
        $mess=DB::table('user_messages')
        ->where('sender_id','=',$request->user_id)
        ->orwhere('receiver_id','=',$request->user_id)
        ->delete();
        $delete = DB::table('baocaovipham')
            ->where('baocaovipham.user_tocao', '=', $request->user_id)
            ->orwhere('baocaovipham.user_id', '=', $request->user_id)
            ->delete();
        $delete = DB::table('friend')
            ->where('friend.user_from', '=', $request->user_id)
            ->orwhere('friend.user_to', '=', $request->user_id)
            ->delete();
        $delete = DB::table('bookmark')
            ->where('bookmark.nguoiluu', '=', $request->user_id)
            ->delete();
        $delete = DB::table('comment')
            ->where('comment.user_id', '=', $request->user_id)
            ->delete();
        $delete = DB::table('school_followers')
            ->where('school_followers.user_id', '=', $request->user_id)
            ->delete();
        $delete = DB::table('school')
            ->where('school.userql', '=', $request->user_id)
            ->delete();
        $delete = DB::table('submissions')
            ->where('submissions.nguoinop_id', '=', $request->user_id)
            ->delete();
            $showpost = DB::table('posts')->where('user_id', '=', $request->user_id)->get();
            foreach ($showpost as $post) {
                $delete = DB::table('file_post')
                    ->where('file_post.post_id', '=', $post->post_id)
                    ->delete();
                $delete = DB::table('baocaopost')
                    ->where('baocaopost.post_id', '=', $post->post_id)
                    ->delete();
                $delete = DB::table('comment')
                    ->where('comment.post_id', '=', $post->post_id)
                    ->delete();
                $delete = DB::table('emoticons')
                    ->where('emoticons.post_id', '=', $post->post_id)
                    ->delete();
                $delete = DB::table('bookmark')
                    ->where('bookmark.baiviet', '=', $post->post_id)
                    ->delete();
                    $delete = DB::table('posts')
                    ->where('post_id', '=', $post->post_id)
            ->delete();
            }


        $delete = DB::table('users')
            ->where('users.user_id', '=', $request->user_id)
            ->delete();


        return response()->json([
            'mess' =>   'Xóa thành công',
            // 'mess' =>   $request->user_id,
        ]);

    }
    public function deletegroup(Request $request)
    {

        $this->AuthLogin();
        $showpost = DB::table('posts')->where('group_id', '=', $request->group_id)->get();
        foreach ($showpost as $post) {
            $delete = DB::table('file_post')
                ->where('file_post.post_id', '=', $post->post_id)
                ->delete();
            $delete = DB::table('baocaopost')
                ->where('baocaopost.post_id', '=', $post->post_id)
                ->delete();
            $delete = DB::table('comment')
                ->where('comment.post_id', '=', $post->post_id)
                ->delete();
            $delete = DB::table('emoticons')
                ->where('emoticons.post_id', '=', $post->post_id)
                ->delete();
            $delete = DB::table('bookmark')
                ->where('bookmark.baiviet', '=', $post->post_id)
                ->delete();
        }
        $delete = DB::table('baocaovipham')
            ->where('group_id', '=', $request->group_id)
            ->delete();
        $delete = DB::table('group_work')
            ->where('group_id', '=', $request->group_id)
            ->delete();
        $delete = DB::table('submissions')
            ->where('group_id', '=', $request->group_id)
            ->delete();
        $delete = DB::table('group_members')
            ->where('group_id', '=', $request->group_id)
            ->delete();
        $delete = DB::table('group')
            ->where('group.group_id', '=', $request->group_id)
            ->delete();
            
        return response()->json([
            'mess' =>   'Xóa thành công',
        ]);
    }
    public function deleteschool(Request $request)
    {
        $this->AuthLogin();


        $showpost = DB::table('posts')->where('school_id', '=', $request->school_id)->get();
        foreach ($showpost as $post) {
            $delete = DB::table('file_post')
                ->where('file_post.post_id', '=', $post->post_id)
                ->delete();
            $delete = DB::table('baocaopost')
                ->where('baocaopost.post_id', '=', $post->post_id)
                ->delete();
            $delete = DB::table('comment')
                ->where('comment.post_id', '=', $post->post_id)
                ->delete();
            $delete = DB::table('emoticons')
                ->where('emoticons.post_id', '=', $post->post_id)
                ->delete();
            $delete = DB::table('bookmark')
                ->where('bookmark.baiviet', '=', $post->post_id)
                ->delete();
        }

        $delete = DB::table('posts')
            ->where('posts.school_id', '=', $request->school_id)
            // ->orwhere('posts.sharepost_id', '=', $request->school_id)
            ->delete();
        $delete = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $request->school_id)
            ->delete();
        $delete = DB::table('school')
            ->where('school.school_id', '=', $request->school_id)
            ->delete();



        return response()->json([
            'mess' =>   'Xóa thành công',
        ]);
    }
}
