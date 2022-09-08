<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
     
    


        $ttin_user = DB::table('users')->where('user_id', $id)->first();
        $ttkb = DB::table('friend')
            ->where([
                ['friend.user_from', '=', $ttin_user->user_id],
                ['friend.user_to', '=', Auth::user()->user_id]
            ])
            ->orWhere([
                ['friend.user_to', '=', $ttin_user->user_id],
                ['friend.user_from', '=', Auth::user()->user_id]
            ])
            ->first();
        $arr[] = ['Công khai'];
        if (Auth::user()->user_id == $id) {
            $arr[] = ['Bạn bè'];
            $arr[] = ['Riêng tư'];
        } else {
            if ($ttkb) {
                $arr[] = ['Bạn bè'];
            }
        }

        $icon = DB::table('icon')->get();

        $slicon = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
            ->groupBy('post_id')
            ->get();
        $emoticons = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            // ->join('posts', 'posts.post_id', '=', 'emoticons.post_id')
            // ->orderBy('posts.post_id', 'DESC')
            // ->where('posts.type_post', '=', '1')
            ->get();

        $baidang = DB::table('users')
            ->join('posts', 'users.user_id', '=', 'posts.user_id')
            ->select('users.*', 'posts.*')
            ->orderBy('post_id', 'DESC')
            ->where('posts.user_id', '=', $id)
            ->where('posts.type_post', '=', '1')
            ->whereIn('posts.status', $arr)
            // ->where('posts.category_post', '<>', '2')
            ->get();
        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            ->where('posts.user_id', '=', $id)
            ->where('posts.type_post', '=', '1')
            // ->whereIn('posts.status', $arr)
            ->get();


        $school = DB::table('school')->where('school.school_id', '=', $ttin_user->school_id)->first();
        $dsschool = DB::table('school')->where('school.school_id', '=', $ttin_user->school_id)->get();

        if (Auth::user()->user_id == $id) {
            return view('myprofile', compact('ttin_user', 'baidang', 'imgbaidang', 'slicon', 'school', 'emoticons', 'ttkb', 'icon','dsschool'));
        } else {
            return view('profile', compact('ttin_user', 'baidang', 'imgbaidang', 'slicon', 'school', 'emoticons', 'ttkb', 'icon'));
        }
    }


    public function uploadavatar(Request $request)
    {

        $usr = DB::table('users')->where('user_id', '=', Auth::user()->user_id)->first();
        if ($request->hasFile('imgavatar')) {
            $completeFileName = $request->file('imgavatar')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('imgavatar')->getClientOriginalExtension();
            $compPic = 'avatar' . Auth::user()->user_id . '-' . rand() . '-' . time() . '.' . $extension;
            $path = $request->file('imgavatar')->storeAs('/assets/img/avatar', $compPic);
            $img_name = $compPic;
            if ($usr->avatar != 'noteimg.png' && !empty($usr->avatar)) {
                $image_path = 'storage/app/assets/img/avatar/' . $usr->avatar;
                unlink($image_path);
            }
            $updateimg = DB::table('users')
                ->where('user_id', '=', Auth::user()->user_id)
                ->update(['avatar'  => $img_name]);
        } else if ($request->hasFile('imgbackground')) {
            $completeFileName = $request->file('imgbackground')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('imgbackground')->getClientOriginalExtension();
            $compPic = 'background' . Auth::user()->user_id . '-' . rand() . '-' . time() . '.' . $extension;
            $path = $request->file('imgbackground')->storeAs('/assets/img/anhbia', $compPic);
            $imgbg_name = $compPic;
            if ($usr->background != 'noimg.jpg' && !empty($usr->background)) {
                $image_path = 'storage/app/assets/img/anhbia/' . $usr->background;
                unlink($image_path);
            }
            $updateimg = DB::table('users')
                ->where('user_id', '=', Auth::user()->user_id)
                ->update(['background'  => $imgbg_name]);
        }

        return back();
    }

    public function profile($id)
    {

        $ttin_user = DB::table('users')->where('user_id', $id)->first();

        $school = DB::table('school')->where('school.school_id', '=', $ttin_user->school_id)->first();
        $listschool = DB::table('school')->where('school_status', '=', '1')->get();
          
        $ttkb = DB::table('friend')
        ->where([
            ['friend.user_from', '=', $ttin_user->user_id],
            ['friend.user_to', '=', Auth::user()->user_id]
        ])
        ->orWhere([
            ['friend.user_to', '=', $ttin_user->user_id],
            ['friend.user_from', '=', Auth::user()->user_id]
        ])
        ->first();
    

        return view('detailprofile', compact('ttin_user', 'school', 'listschool','ttkb'));
    }
    public function profile_friend($id)
    {
        $ttin_user = DB::table('users')->where('user_id', $id)->first();
        $school = DB::table('school')->where('school.school_id', '=', $ttin_user->school_id)->first();
        $listschool = DB::table('school')->where('school_status', '=', '1')->get();
        $user_friends = DB::table('friend')
            ->where([
                ['friend.user_from', '=', $id],
                ['friend.user_to', '<>', null],
                ['friend.f_trangthai', '<>', '1'],
            ])
            ->orWhere([
                ['friend.user_from', '<>', null],
                ['friend.user_to', '=', $id],
                ['friend.f_trangthai', '=', '1'],
            ])
            ->get();
        $datafriends = [];
        foreach ($user_friends as $user_friend) {
            if ($user_friend->user_from == $id) {
                $datafriends[] = $user_friend->user_to;
            }
            if ($user_friend->user_to == $id) {
                $datafriends[] = $user_friend->user_from;
            }
        }

        $friends = DB::table('users')
            ->where('users.user_id', '<>', $id)
            ->whereIn('users.user_id', $datafriends)
            ->get();

            
            $ttkb = DB::table('friend')
            ->where([
                ['friend.user_from', '=', $ttin_user->user_id],
                ['friend.user_to', '=', Auth::user()->user_id]
            ])
            ->orWhere([
                ['friend.user_to', '=', $ttin_user->user_id],
                ['friend.user_from', '=', Auth::user()->user_id]
            ])
            ->first();
        


        return view('profile_friend', compact('ttin_user', 'school', 'listschool', 'friends','ttkb'));
    }
    public function editprofile(Request $request)
    {
        $update = DB::table('users')
            ->where('user_id', '=', $request->iduser)
            ->update([
                'firstname' =>  $request->ho,
                'name' =>  $request->ten,
                'sex' =>  $request->gioitinh,
                'birthday' =>  $request->ngaysinh,
                'job' =>  $request->nghenghiep,
                'address' =>  $request->diachi,
                'school_id' =>  $request->truonghoc,
            ]);
        // var_dump($request->iduser);
        $link = 'profile/' . $request->iduser . '/about';
        return Redirect('profile/' . $request->iduser . '/about')->with('tbaoprofile', 'Thành công');

        // return back();
    }
}
