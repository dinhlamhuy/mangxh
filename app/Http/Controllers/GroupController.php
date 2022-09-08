<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\GroupWork;
use App\Models\GroupMember;
use App\Models\Friend;

class GroupController extends Controller
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

    public function group()
    {
        $friend = DB::table('friend')
            ->where([
                ['friend.user_from', '=', Auth::user()->user_id],
                ['friend.user_to', '<>', null],
            ])
            ->orWhere([
                ['friend.user_from', '<>', null],
                ['friend.user_to', '=', Auth::user()->user_id],
            ])->get();
        $datafri = [];
        foreach ($friend as $fri) {
            if ($fri->user_from == Auth::user()->user_id) {
                $datafri[] = $fri->user_to;
            }
            if ($fri->user_to == Auth::user()->user_id) {
                $datafri[] = $fri->user_from;
            }
        }
        $friends = DB::table('users')
            ->whereIn('user_id', $datafri)
            ->get();
         


        return view('groups.create_group', compact('friends'));
    }


    public function create_group(Request $request)
    {
        $data['group_name'] = $request->name_group;
        $data['group_founder'] = Auth::user()->user_id;
        $data['group_privacy'] = $request->rules;
        if ($request->hasFile('bg_group')) {
            $completeFileName = $request->file('bg_group')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('bg_group')->getClientOriginalExtension();
            $compPic = 'group_' . rand() . '_' . time() . '.' . $extension;
            $path = $request->file('bg_group')->storeAs('/assets/img/group', $compPic);
            $img_name = $compPic;
            $data['group_imgbg'] = $img_name;
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $NewGroup = Group::create($data);

        $memberData['user_id'] = Auth::user()->user_id;
        $memberData['group_id'] = $NewGroup->group_id;
        $memberData['group_status'] = '1';
        GroupMember::create($memberData);
        if (!empty($request->friend_invitation)) {
            foreach ($request->friend_invitation as $friend) {
                $memberData['user_id'] = $friend;
                $memberData['group_id'] = $NewGroup->group_id;
                $memberData['group_status'] = '1';
                GroupMember::create($memberData);
            }
        }
        return redirect('/groups/' . $NewGroup->group_id);
    }

    public function feed_group()
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
        
        
        $memgroups = DB::table('group')
        ->join('group_members', 'group_members.group_id', '=', 'group.group_id')
        ->where('group_members.user_id', Auth::user()->user_id)
        ->where('group_members.group_status', '1')
        // ->where('group.group_founder', '<>', Auth::user()->user_id)
        ->get();
        $datamem = [];
        foreach ($memgroups as $mem) {
            
                $datamem[] = $mem->group_id;
            
        }


        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();
            $baidang = DB::table('users')
            ->join('posts', 'users.user_id', '=', 'posts.user_id')
            ->join('group', 'group.group_id', 'posts.group_id')
            ->select('users.*', 'posts.*', 'group.*', 'posts.created_at as thoigiandang')
            ->orderBy('post_id', 'DESC')
            ->where('posts.type_post', '=', '2')
            // ->where('posts.category_post', '=', '1')
            ->whereIn('posts.group_id', $datamem)
            ->get();
        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            ->where('posts.type_post', '=', '2')
            ->get();
        $icon = DB::table('icon')->get();

        $slicon = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
            ->groupBy('post_id')
            ->get();
            $emoticons = DB::table('emoticons')
            ->join('icon','icon.icon_id','=','emoticons.icon_id')
            ->get();
        // $slicon = DB::table('emoticons')
        //     ->select(DB::raw('count(*) as bieucam, post_id', 'emoticons_symbol'))
        //     ->groupBy('post_id')
        //     ->get();
        $mygroups = DB::table('group')
            ->join('group_members', 'group_members.group_id', '=', 'group.group_id')
            ->where('group_members.user_id', Auth::user()->user_id)
            ->where('group.group_founder', '<>', Auth::user()->user_id)
            ->where('group_members.group_status', '=', '1')
            ->get();
        $group_founder = DB::table('group')
            ->where('group.group_founder', Auth::user()->user_id)
            ->get();
            $kttv = DB::table('group_members')
            // ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.user_id', '=', Auth::user()->user_id)
            ->get();
        return view('groups.groups', compact('friends', 'mygroups', 'baidang', 'imgbaidang', 'emoticons', 'icon', 'slicon', 'group_founder','kttv'));
    }


    public function about_group($id)
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
        $group = DB::table('group')
            ->Where('group.group_id', '=', $id)
            ->first();
        $num_members = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.group_status', '=', '1')
            ->count();
            $dsnhom = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.group_status', '=', '1')
            ->get();

            $ktthanhvien = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.user_id', '=', Auth::user()->user_id)
            ->Where('group_members.group_status', '=', '1')
            ->first();

        return view('groups.about', compact('friends', 'group', 'dsnhom','num_members','ktthanhvien'));
    }


    public function dskiemduyet($id)
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
        $group = DB::table('group')
            ->Where('group.group_id', '=', $id)
            ->first();
        $num_members = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.group_status', '=', '1')
            ->count();
        $members = DB::table('group_members')
            ->join('users', 'users.user_id', '=', 'group_members.user_id')
            ->where('group_members.group_id', '=', $id)
            ->where('group_members.group_status', '=', '0')
            ->get();
        $dsnhom = DB::table('group_members')->Where('group_members.group_id', '=', $id)->where('group_members.group_status', '=', '1')->select('user_id')->get()->toArray();

        if ($group->group_founder == Auth::user()->user_id) {

            return view('groups.duyetthanhvien', compact('friends', 'group', 'members', 'num_members', 'dsnhom'));
        } else {
            return view('err');
        }
    }
    public function duyettv(Request $request)
    {
        $group = DB::table('group')
            ->Where('group.group_id', '=', $request->group_id)
            ->first();

        $members = DB::table('group_members')
            ->where('group_members.group_id', '=', $request->group_id)
            ->where('group_members.user_id', '=', $request->user_id)
            ->update(['group_status' => '1']);
        $mess = "Đã duyệt";
        return response()->json([
            'nd'    =>  $mess
        ]);
    }
    public function moivaogroup(Request $request)
    {
        $mess = '';
        foreach ($request->danhsachmoiban as $damoi) {

            $members = DB::table('group_members')
                ->where('group_members.group_id', '=', $request->group_id)
                ->where('group_members.user_id', '=', $damoi)
                ->first();
            if (!$members) {

                $add = DB::table('group_members')->insert([
                    'group_id'  =>  $request->group_id,
                    'user_id'  =>  $damoi,
                    'group_status'  =>  '2',
                    'created_at'  =>  date('Y-m-d H:i:s'),
                    'updated_at'  =>  date('Y-m-d H:i:s'),

                ]);
            }
        }

        return response()->json([
            'nd'    => 'Mời thành công'
        ]);
    }



    // đổi ảnh bìa
    public function updategroup(Request $request){

        $grp = DB::table('group')
        ->where('group_id', '=', $request->group_id)->update([
            'group_name'    =>  $request->group_name,
            'group_name'    =>  $request->group_name,

        ]);

return back();

    }
    public function uploadimggroup(Request $request)
    {
        $grp = DB::table('group')
        ->where('group_id', '=', $request->group_id)->first();
   

        if ($request->hasFile('imgbackground')) {
            $completeFileName = $request->file('imgbackground')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('imgbackground')->getClientOriginalExtension();
            $compPic = 'group' . $request->group_id . '-' . rand() . '-' . time() . '.' . $extension;
            $path = $request->file('imgbackground')->storeAs('/assets/img/group/', $compPic);
            $imgbg_name = $compPic;
            if ($grp->group_imgbg != 'noimg.jpg' && !empty($grp->group_imgbg)) {
                $image_path = 'storage/app/assets/img/group/' . $grp->group_imgbg;
                unlink($image_path);
            }
            $updateimg = DB::table('group')
                ->where('group_id', '=', $request->group_id)
                ->update(['group_imgbg'  => $imgbg_name]);
        }
        return back();
    }


    //trang chủ của nhóm
    public function page_group($id)
    {
        $baidang = DB::table('users')
            ->join('posts', 'users.user_id', '=', 'posts.user_id')
            ->join('group', 'group.group_id', 'posts.group_id')
            ->select('users.*', 'posts.*', 'group.*', 'posts.created_at as thoigiandang')
            ->orderBy('post_id', 'DESC')
            ->where('posts.group_id', '=', $id)
            ->where('posts.type_post', '=', '2')
            // ->where('posts.category_post', '=', '1')
            ->get();
        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            ->where('posts.group_id', '=', $id)
            ->where('posts.type_post', '=', '2')
            ->get();
        $icon = DB::table('icon')->get();

        $slicon = DB::table('emoticons')
            ->join('icon', 'icon.icon_id', '=', 'emoticons.icon_id')
            ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
            ->groupBy('post_id')
            ->get();
            $emoticons = DB::table('emoticons')
            ->join('icon','icon.icon_id','=','emoticons.icon_id')
            ->get();
        $group = DB::table('group')
            ->Where('group.group_id', '=', $id)
            ->first();
        $num_members = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.group_status', '=', '1')
            ->count();
    //    $ktthanhvien = DB::table('group_members')
    //         ->Where('group_members.group_id', '=', $id)
    //         ->Where('group_members.user_id', '=', Auth::user()->user_id)
    //         ->Where('group_members.group_status', '=', '1')
    //         ->first();
            $ktthanhvien = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.user_id', '=', Auth::user()->user_id)
            ->first();


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
        $dsnhom = DB::table('group_members')->Where('group_members.group_id', '=', $id)->where('group_members.group_status', '=', '1')->select('user_id')->get()->toArray();

        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            // ->whereNotIn('user_id', DB::table('group_members')->Where('group_members.group_id', '=', $id)->select('user_id')->select('user_id') ->get()->toArray())
            ->whereIn('users.user_id', $datafriends)
            ->select('users.*')
            ->get();
        return view('groups.group_index', compact('friends', 'group', 'num_members', 'baidang', 'icon', 'imgbaidang', 'emoticons', 'slicon', 'ktthanhvien', 'dsnhom'));
    }


    public function work_group($id)
    {
        $group = DB::table('group')
            ->Where('group.group_id', '=', $id)
            ->first();
        $group_work = DB::table('group_work')
            ->Where('group_work.group_id', '=', $id)
            ->get();
        $num_members = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.group_status', '=', '1')
            ->count();
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
            $dsnhom = DB::table('group_members')->Where('group_members.group_id', '=', $id)->where('group_members.group_status', '=', '1')->select('user_id')->get()->toArray();
        $ktthanhvien = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.user_id', '=', Auth::user()->user_id)
            ->Where('group_members.group_status', '=', '1')
            ->first();
        return view('groups.work', compact('group', 'num_members', 'group_work', 'friends', 'ktthanhvien', 'dsnhom'));
    }


    public function add_work(Request $request)
    {
        $data = [];
        $groupwork = new GroupWork;

        $data['gw_tieude'] = $request->gw_tieude;
        $data['gw_noidung'] = $request->gw_noidung;
        $data['nguoitao_id'] = Auth::user()->user_id;
        $data['group_id'] = $request->group_id;
        if ($request->hasFile('gw_file')) {
            $completeFileName = $request->file('gw_file')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('gw_file')->getClientOriginalExtension();
            $fileNameOnly = str_replace(',', '_', $fileNameOnly);
            $compPic = str_replace(' ', '_', $fileNameOnly) . '_' . rand() . '_' . time() . '.' . $extension;
            $path = $request->file('gw_file')->storeAs('/assets/bainop', $compPic);
            $img_name = $compPic;
            $data['gw_file'] = $request->gw_tieude;
        }
    }





    public function adduser_group(Request $request)
    {

        $result = DB::table('group_members')
            ->where('group_members.group_id', '=', $request->group_id)
            ->where('group_members.user_id', '=', $request->user_id)
            ->first();
        // var_dump($result);
        if ($result) {
            
        } else {
            if (!empty($request->group_id)) {
                $memberData['user_id'] = $request->user_id;
                $memberData['group_id'] = $request->group_id;
                $memberData['group_status'] = '0';
                GroupMember::create($memberData);
                $mess = "Đã gửi yêu cầu tham gia";
            }
        }
        return response()->json([
            'nd'    =>  $mess
        ]);
    }

    public function loimoigroup()
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
        $mygroups = DB::table('group')
            ->join('group_members', 'group_members.group_id', '=', 'group.group_id')
            ->where('group_members.user_id', Auth::user()->user_id)
            ->where('group.group_founder', '<>', Auth::user()->user_id)
            ->get();
        $group_founder = DB::table('group')
            ->where('group.group_founder', Auth::user()->user_id)
            ->get();
        $dsnhom = DB::table('group')
            ->join('group_members', 'group_members.group_id', '=', 'group.group_id')
            ->where('group_members.user_id', '=', Auth::user()->user_id)
            ->where('group_members.group_status', '=', '2')
            ->get();
        return view('groups.loimoi', compact('group_founder', 'mygroups', 'dsnhom', 'friends'));
    }

    public function nhanloimoi(Request $request)
    {
        $result = DB::table('group_members')
            ->where('group_members.group_id', '=', $request->group_id)
            ->where('group_members.user_id', '=', $request->user_id)
            ->where('group_members.group_status', '=', '2')
            ->first();
        if ($result) {
            $update = DB::table('group_members')
                ->where('group_members.group_id', '=', $request->group_id)
                ->where('group_members.user_id', '=', $request->user_id)
                ->update([
                    'group_status'  =>  '1'
                ]);
        }
        return response()->json([
            'nd'    =>  'Đã tham gia nhóm'
        ]);
    }
    public function huyloimoi(Request $request)
    {

        $result = DB::table('group_members')
            ->where('group_members.group_id', '=', $request->group_id)
            ->where('group_members.user_id', '=', $request->user_id)
            ->delete();
            return response()->json([
                'nd'    =>  'Hủy thành công'
            ]);
    }

    public function gmember($id)
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
        $group = DB::table('group')
            ->Where('group.group_id', '=', $id)
            ->first();
        $num_members = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.group_status', '=', '1')
            ->count();
        $dsnhom = DB::table('group')
            ->join('group_members', 'group_members.group_id', '=', 'group.group_id')
            ->Where('group.group_id', '=', $id)
            ->where('group_members.user_id', '=', Auth::user()->user_id)
            ->where('group_members.group_status', '=', '0')
            ->get();
        $ktthanhvien = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.user_id', '=', Auth::user()->user_id)
            ->Where('group_members.group_status', '=', '1')
            ->first();

        $list_members = DB::table('group_members')
            ->join('users', 'users.user_id', '=', 'group_members.user_id')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.group_status', '=', '1')
            ->get();

        return view('groups.thanhvien', compact('friends', 'group', 'num_members', 'dsnhom', 'ktthanhvien','list_members'));
    }

    public function roinhom(Request $request){

        $result = DB::table('group_members')
        ->where('group_members.group_id', '=', $request->group_id)
        ->where('group_members.user_id', '=', $request->user_id)
        ->first();


        $roinhom = DB::table('group_members')
        ->where('group_members.group_id', '=', $request->group_id)
        ->where('group_members.user_id', '=', Auth::user()->user_id)
        // ->where('group_members.group_status', '=', '1')
        ->delete();
        return response()->json([
            'nd'    =>  'thành công'
        ]);

        

    }
}
