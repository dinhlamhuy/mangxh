<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Schools;
// use App\Models\GroupMember;

class FanpagesController extends Controller
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

    public function fanpages($id)
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

        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();





        $baidang = DB::table('school')
            ->join('posts', 'posts.school_id', '=', 'school.school_id')
            ->join('users', 'users.user_id', '=', 'posts.user_id')
            ->select('school.*', 'posts.*', 'users.*', 'school.school_id as idschool')
            ->orderBy('post_id', 'DESC')
            ->where('posts.school_id', '=', $id)
            ->where('posts.type_post', '=', '3')
            ->where('posts.post_choduyet', '=', '1')
            ->get();
        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            ->where('posts.school_id', '=', $id)
            ->where('posts.type_post', '=', '3')
            ->where('posts.post_choduyet', '=', '1')
            ->get();
        $icon = DB::table('icon')->get();

        $slicon = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
            ->groupBy('post_id')
            ->get();
        $emoticons = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->get();
        $school = DB::table('school')
            ->where('school.school_id', '=', $id)
            ->first();
        $followers = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $id)
            ->where('school_followers.fl_status', '=', '1')
            ->get();
        $myfollow = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $id)
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->first();
        if ($school->userql == Auth::user()->user_id) {
            return view('fanpages.mananger', compact('friends', 'school', 'followers', 'baidang', 'imgbaidang', 'emoticons', 'icon', 'slicon'));
        } else {
            return view('fanpages.index', compact('friends', 'school', 'followers', 'baidang', 'imgbaidang', 'emoticons', 'icon', 'slicon', 'myfollow'));
        }
    }



    public function school_about($school_id)
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

        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();


        $school = DB::table('school')
            ->where('school.school_id', '=', $school_id)
            ->first();
        $followers = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $school_id)
            ->where('school_followers.fl_status', '=', '1')
            ->get();
        $myfollow = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $school_id)
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            // ->where('school_followers.fl_status', '=', '1')
            ->first();
        if ($school->userql == Auth::user()->user_id) {
            return view('fanpages.updateabout', compact('friends', 'school', 'followers'));
        } else {
            return view('fanpages.about', compact('friends', 'school', 'followers', 'myfollow'));
        }
    }


    public function create()
    {
        return view('fanpages.create_fanpage');
    }
    public function create_fanpages(Request $request)
    {
        $data['school_name'] = $request->name_fanpage;
        $data['userql'] = Auth::user()->user_id;
        $data['school_category'] = $request->school_category;
        $data['school_address'] = $request->diachi_fanpage;
        $data['school_email'] = $request->email_fanpage;
        $data['school_phone'] = $request->sdt_fanpage;
        $data['school_about'] = nl2br($request->mota);
        $data['school_status'] = '2';
        Schools::create($data);

        return redirect('/fanpages/create')->with('status', 'Vui lòng chờ Quản trị viên duyệt yêu cầu!');
    }
    public function feed()
    {

        $memschool = DB::table('school')
            ->leftjoin('school_followers', 'school_followers.school_id', '=', 'school.school_id')
            // ->where('school_followers.fl_status', '1')
            ->where('school_followers.user_id', Auth::user()->user_id)
            ->orwhere('school.userql', Auth::user()->user_id)
            ->select('*', 'school.school_id as idtruong')
            ->get();
        $dataschool = [];
        foreach ($memschool as $mem) {

            $dataschool[] = $mem->idtruong;
        }
        $baidang = DB::table('school')
            ->join('posts', 'posts.school_id', '=', 'school.school_id')
            ->join('users', 'users.user_id', '=', 'posts.user_id')
            ->select('school.*', 'posts.*', 'users.*', 'school.school_id as idschool')
            ->orderBy('post_id', 'DESC')
            ->where('posts.type_post', '=', '3')
            // ->where('posts.category_post', '=', '1')
            ->where('posts.post_choduyet', '=', '1')
            ->whereIn('posts.school_id', $dataschool)
            ->get();
        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            ->where('posts.type_post', '=', '3')
            ->get();
        $icon = DB::table('icon')->get();

        $slicon = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
            ->groupBy('post_id')
            ->get();
        $emoticons = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->get();
        $myschoolmanager = DB::table('school')
            ->where('school.userql', '=', Auth::user()->user_id)
            ->get();
        $myschool = DB::table('school')
            ->join('school_followers', 'school_followers.school_id', '=', 'school.school_id')
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->where('school_followers.fl_status', '=', '1')
            // ->select('school.*','school_followers.*','school_followers.school_id as school_followers')
            ->get();
        $followers = DB::table('school_followers')
            ->where('school_followers.fl_status', '=', '1')
            ->get();


        return view('fanpages.fanpages', compact('myschool', 'followers', 'baidang', 'imgbaidang', 'emoticons', 'slicon', 'icon', 'myschoolmanager'));
    }

    public function follow(Request $request)
    {

        $result = DB::table('school_followers')
            ->where('school_id', '=', $request->school_id)
            ->where('user_id', '=', $request->user_id)
            ->first();
        if ($result) {
            $delete = DB::table('school_followers')
                ->where('school_id', '=', $request->school_id)
                ->where('user_id', '=', $request->user_id)
                ->delete();
            $mess = "<i class='fa fa-rss' aria-hidden='true'></i>&ensp;Theo dõi";
        } else {

            $add = DB::table('school_followers')->insert([
                'school_id' =>  $request->school_id,
                'user_id' =>  $request->user_id,
                'fl_status' =>  '1',
            ]);
            $mess = "Đã theo dõi";
        }
        return response()->json([
            'nd'    =>  $mess
        ]);
    }
    public function unfollower(Request $request)
    {
        $botheodoi = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $request->group_id)
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->delete();
        return response()->json([
            'nd'    =>  'Thành công'
        ]);
    }

    public function updateinfo(Request $request)
    {


        $school = DB::table('school')
            ->where('school.school_id', '=', $request->school_id)
            ->first();


        if ($request->hasFile('school_avatar')) {
            $completeFileName = $request->file('school_avatar')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('school_avatar')->getClientOriginalExtension();
            $compPic = 'avatarschool' . Auth::user()->user_id . '-' . rand() . '-' . time() . '.' . $extension;
            $path = $request->file('school_avatar')->storeAs('/assets/img/school', $compPic);
            $img_name = $compPic;
            if ($school->school_avatar != 'noteimgschool.png' && !empty($school->school_avatar)) {
                $image_path = 'storage/app/assets/img/school/' . $school->school_avatar;
                unlink($image_path);
            }
        } else {
            $img_name = $school->school_avatar;
        }

        if ($request->hasFile('school_background')) {
            $completeFileName = $request->file('school_background')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('school_background')->getClientOriginalExtension();
            $compPic = 'background' . Auth::user()->user_id . '-' . rand() . '-' . time() . '.' . $extension;
            $path = $request->file('school_background')->storeAs('/assets/img/anhbia', $compPic);
            $imgbg_name = $compPic;
            if ($school->school_background != 'backgroundschool.jpg' && !empty($school->school_background)) {
                $image_path = 'storage/app/assets/img/anhbia/' . $school->school_background;
                unlink($image_path);
            }
        } else {
            $imgbg_name = $school->school_background;
        }
        $update = DB::table('school')
            ->where('school_id', '=', $request->school_id)
            ->update([
                'school_name'   =>  $request->school_name,
                'school_category'   =>  $request->school_category,
                'school_address'   =>  $request->school_address,
                'school_phone'   =>  $request->school_phone,
                'school_email'   =>  $request->school_email,
                'school_link'   =>  $request->school_link,
                'school_about'   =>  $request->school_about,
                'school_avatar'   =>  $img_name,
                'school_background'   =>  $imgbg_name,
            ]);

        return redirect('/fanpage/' . $request->school_id . '/about');
    }


    public function postchoduyet($school_id)
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

        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();
        $baidang = DB::table('school')
            ->join('posts', 'school.school_id', '=', 'posts.school_id')
            ->join('users', 'users.user_id', '=', 'posts.user_id')
            ->select('school.*', 'posts.*', 'users.*')
            ->orderBy('post_id', 'DESC')
            ->where('posts.school_id', '=', $school_id)
            ->where('posts.type_post', '=', '3')
            ->where('posts.post_choduyet', '=', '0')
            // ->where('posts.category_post', '=', '1')
            ->get();
        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            ->where('posts.school_id', '=', $school_id)
            ->where('posts.post_choduyet', '=', '0')
            ->where('posts.type_post', '=', '3')
            ->get();
        $icon = DB::table('icon')->get();

        $slicon = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
            ->groupBy('post_id')
            ->get();
        $emoticons = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->get();
        $school = DB::table('school')
            ->where('school.school_id', '=', $school_id)
            ->first();
        $followers = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $school_id)
            ->where('school_followers.fl_status', '=', '1')
            ->get();
        $myfollow = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $school_id)
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->first();
        if ($school->userql == Auth::user()->user_id) {
            return view('fanpages.qlbaidang', compact('friends', 'school', 'followers', 'baidang', 'imgbaidang', 'emoticons', 'icon', 'slicon'));
        } else {
            return view('fanpages.err');
        }
    }
    public function duyetbai(Request $request)
    {
        $update = DB::table('posts')
            ->where('post_id', '=', $request->post_id)
            ->update([
                'post_choduyet'     =>  '1'
            ]);
        return response()->json([
            'kq'    =>  '1'
        ]);
    }


    public function nguoitheodoi($school_id)
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

        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();
        $school = DB::table('school')
            ->where('school.school_id', '=', $school_id)
            ->first();
        $followers = DB::table('school_followers')
            ->join('users', 'users.user_id', '=', 'school_followers.user_id')
            ->where('school_followers.school_id', '=', $school_id)
            ->where('school_followers.fl_status', '=', '1')
            ->get();

        if ($school->userql == Auth::user()->user_id) {
            return view('fanpages.fanfollower', compact('friends', 'school', 'followers'));
        } else {
            return view('fanpages.err');
        }
    }
    public function moibbfollow(Request $request)
    {
        foreach ($request->danhsachmoiban as $damoi) {
            $result = DB::table('school_followers')
                ->where('school_id', '=', $request->school_id)
                ->where('user_id', '=', $damoi)
                ->first();
            if ($result) {
            } else {
                $add = DB::table('school_followers')->insert([
                    'school_id' =>  $request->school_id,
                    'user_id' =>  $damoi,
                    'fl_status' =>  '0',
                ]);
            }
        }
        $mess = "Đã mời";
        return response()->json([
            'nd'    =>  $mess
        ]);
    }
    public function loimoi()
    {
        $memschool = DB::table('school')
            ->leftjoin('school_followers', 'school_followers.school_id', '=', 'school.school_id')
            // ->where('school_followers.fl_status', '1')
            ->where('school_followers.user_id', Auth::user()->user_id)
            ->orwhere('school.userql', Auth::user()->user_id)
            ->select('*', 'school.school_id as idtruong')
            ->get();
        $dataschool = [];
        foreach ($memschool as $mem) {

            $dataschool[] = $mem->idtruong;
        }
        $baidang = DB::table('school')
            ->join('posts', 'posts.school_id', '=', 'school.school_id')
            ->join('users', 'users.user_id', '=', 'posts.user_id')
            ->select('school.*', 'posts.*', 'users.*', 'school.school_id as idschool')
            ->orderBy('post_id', 'DESC')
            ->where('posts.type_post', '=', '3')
            // ->where('posts.category_post', '=', '1')
            ->where('posts.post_choduyet', '=', '1')
            ->whereIn('posts.school_id', $dataschool)
            ->get();
        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            ->where('posts.type_post', '=', '3')
            ->get();
        $icon = DB::table('icon')->get();

        $slicon = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
            ->groupBy('post_id')
            ->get();
        $emoticons = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->get();
        $myschoolmanager = DB::table('school')
            ->where('school.userql', '=', Auth::user()->user_id)
            ->get();
        $myschool = DB::table('school')
            ->join('school_followers', 'school_followers.school_id', '=', 'school.school_id')
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->where('school_followers.fl_status', '=', '1')
            // ->select('school.*','school_followers.*','school_followers.school_id as school_followers')
            ->get();
        $followers = DB::table('school_followers')
            ->where('school_followers.fl_status', '=', '1')
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->get();
        $dsfollow = DB::table('school_followers')
            ->join('school', 'school.school_id', '=', 'school_followers.school_id')
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->where('school_followers.fl_status', '=', '0')
            ->get();

        return view('fanpages.loimoi', compact('myschool', 'followers', 'baidang', 'imgbaidang', 'emoticons', 'slicon', 'icon', 'myschoolmanager', 'dsfollow'));
    }


    public function nhanloimoi(Request $request)
    {
        $result = DB::table('school_followers')
            ->join('school', 'school.school_id', '=', 'school_followers.school_id')
            ->where('school_followers.school_id', '=', $request->school_id)
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->where('school_followers.fl_status', '=', '0')
            ->first();
        if ($result) {
            $update = DB::table('school_followers')
                ->where('school_followers.school_id', '=', $request->school_id)
                ->where('school_followers.user_id', '=', Auth::user()->user_id)
                ->update([
                    'fl_status'  =>  '1'
                ]);
            }
            return response()->json([
                'nd'    =>  'Đã tham dõi trang'
            ]);
       
    }
    public function huyloimoi(Request $request)
    {

        $result = DB::table('school_followers')
            ->where('school_followers.school_id', '=', $request->school_id)
            ->where('school_followers.user_id', '=', Auth::user()->user_id)
            ->delete();
        return response()->json([
            'nd'    =>  'Hủy lời mời thành công'
        ]);
    }
}
