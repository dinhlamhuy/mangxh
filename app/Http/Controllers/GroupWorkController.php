<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\GroupWork;
use App\Models\GroupMember;
use App\Models\Submissions;

class GroupWorkController extends Controller
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
    public function group_work($id)
    {
        $group = DB::table('group')
            ->Where('group.group_id', '=', $id)
            ->first();
        $group_work = DB::table('group_work')
            ->join('users', 'users.user_id', '=', 'nguoitao_id')
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
        $ktthanhvien = DB::table('group_members')
            ->Where('group_members.group_id', '=', $id)
            ->Where('group_members.user_id', '=', Auth::user()->user_id)
            ->first();
        $dsnhom = DB::table('group_members')->Where('group_members.group_id', '=', $id)->where('group_members.group_status', '=', '1')->select('user_id')->get()->toArray();

        return view('groups.work', compact('group', 'num_members', 'group_work', 'friends', 'ktthanhvien', 'dsnhom'));
    }
    public function detail_group_work($group_id, $gw_id)
    {
        $group = DB::table('group')
            ->Where('group.group_id', '=', $group_id)
            ->first();
        $group_work = DB::table('group_work')
            ->join('users', 'users.user_id', '=', 'nguoitao_id')
            ->Where('group_work.group_id', '=', $group_id)
            ->Where('group_work.gw_id', '=', $gw_id)
            ->first();
        $num_members = DB::table('group_members')
            ->Where('group_members.group_id', '=', $group_id)
            ->count();

        $smission = DB::table('submissions')
            ->join('users', 'users.user_id', '=', 'submissions.nguoinop_id')
            // ->select('*', 'submissions.created_at as ngaynop')
            ->where('submissions.gw_id', '=', $gw_id)
            ->get();
        $mysmission = DB::table('submissions')
            ->join('group_work', 'group_work.group_id', '=', 'submissions.group_id')
            ->join('users', 'users.user_id', '=', 'submissions.nguoinop_id')
            ->Where('submissions.gw_id', '=', $gw_id)
            ->Where('submissions.nguoinop_id', '=', Auth::user()->user_id)
            ->select('*', 'submissions.updated_at as ngaynop')
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
        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();
        $ktthanhvien = DB::table('group_members')
            ->Where('group_members.group_id', '=', $group_id)
            ->Where('group_members.user_id', '=', Auth::user()->user_id)
            ->first();
        $dsnhom = DB::table('group_members')->Where('group_members.group_id', '=', $group_id)->where('group_members.group_status', '=', '1')->get();
        if(!empty($group_work->gw_id)){
            return view('groups.detailwork', compact('group', 'num_members', 'group_work', 'smission', 'mysmission', 'friends', 'ktthanhvien', 'dsnhom'));
        }else{
            return view('groups.err');
        }
    }

    public function add_work(Request $request)
    {
        $data = [];
        $datetime = $request->gw_time . '' . $request->gw_date;
        $groupwork = new GroupWork;
        $data['gw_tieude'] = $request->gw_tieude;
        if (!empty($request->gw_noidung)) {
            $data['gw_noidung'] = nl2br($request->gw_noidung);
        }
        $data['gw_hannop'] = date('Y-m-d H:i:s', strtotime($datetime));
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
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
            $data['gw_file'] = $img_name;
            $data['gw_typefile'] = $request->gw_typefile;
        }
        groupwork::insert($data);
        return response()->json([
            'datawork'  =>  $data
        ]);
    }

    public function edit_work(Request $request)
    {
        $data = [];
        $datetime = $request->gw_time . '' . $request->gw_date;
        $noidung='';
        $gw_file='';
        $gw_typefile='';
        if (!empty($request->gw_noidung)) {
            $noidung = nl2br($request->gw_noidung);
        }
      
        if ($request->hasFile('gw_file')) {
            $completeFileName = $request->file('gw_file')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('gw_file')->getClientOriginalExtension();
            $fileNameOnly = str_replace(',', '_', $fileNameOnly);
            $compPic = str_replace(' ', '_', $fileNameOnly) . '_' . rand() . '_' . time() . '.' . $extension;
            $path = $request->file('gw_file')->storeAs('/assets/bainop', $compPic);
            $img_name = $compPic;
            $gw_file = $img_name;
            $gw_typefile = $request->gw_typefile;
        }else {
            $check=DB::table('group_work')
            ->where('group_id','=',$request->group_id)
            ->where('gw_id','=',$request->gw_id)
            ->first();
            $gw_file = $check->gw_file;
            $gw_typefile = $check->gw_typefile;
        }
    

        $edit=DB::table('group_work')
        ->where('group_id','=',$request->group_id)
        ->where('gw_id','=',$request->gw_id)
        ->update([
            'gw_tieude' =>  $request->gw_tieude,
            'gw_noidung' =>  $noidung,
            'gw_file' =>   $gw_file,
            'gw_typefile' =>   $gw_typefile,
            'gw_hannop' =>  date('Y-m-d H:i:s', strtotime($datetime)),
            'updated_at'    =>  date('Y-m-d H:i:s'),
        ]);
        return redirect('/groups/'.$request->group_id.'/work/'.$request->gw_id)->with('messgw','Cập nhật thành công');

    }
    public function delete_work(Request $request)
    {
        $delete=DB::table('group_work')
            ->where('group_id','=',$request->group_id)
            ->where('gw_id','=',$request->gw_id)
            ->delete();
        $delete=DB::table('submissions')
            ->where('group_id','=',$request->group_id)
            ->where('gw_id','=',$request->gw_id)
            ->delete();
        return redirect('/groups/'.$request->group_id.'/work')->with('messgw','Xóa công việc thành công');

    }
    public function upload_submissions(Request $request)
    {
        $check = DB::table('submissions')->where('nguoinop_id', '=', Auth::user()->user_id)->where('gw_id', '=', $request->gw_id)->where('group_id', '=', $request->group_id)->first();
        if ($check) {
            $noidung = '';
            if (!empty($request->sm_noidung)) {
                $noidung = nl2br($request->sm_noidung);
            }
            $tenfile = '';
            $typefile = '';
            if ($request->hasFile('sm_file')) {
                $completeFileName = $request->file('sm_file')->getClientOriginalName();
                $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                $extension = $request->file('sm_file')->getClientOriginalExtension();
                $fileNameOnly = str_replace(',', '_', $fileNameOnly);
                $compPic = str_replace(' ', '_', $fileNameOnly) . '_' . rand() . '_' . time() . '.' . $extension;
                $path = $request->file('sm_file')->storeAs('/assets/bainop', $compPic);
                $img_name = $compPic;
                $tenfile = $img_name;
                $typefile = $request->sm_typefile;
            } else {
                $tenfile = $check->sm_file;
                $typefile = $check->sm_typefile;
            }
            // submissions::update($data);
            $update = DB::table('submissions')
                ->where('nguoinop_id', '=', Auth::user()->user_id)
                ->where('gw_id', '=', $request->gw_id)
                ->where('group_id', '=', $request->group_id)
                ->update([
                    'sm_ngaynop'    =>  date('Y-m-d H:i:s'),
                    'sm_noidung'    =>  $noidung,
                    'updated_at'    =>  date('Y-m-d H:i:s'),
                    'sm_file'    =>  $tenfile,
                    'sm_typefile'    =>  $typefile,
                ]);
        } else {
            $data = [];
            if (!empty($request->sm_noidung)) {
                $data['sm_noidung'] = nl2br($request->sm_noidung);
            }
            $data['sm_ngaynop'] = date('Y-m-d H:i:s');
            $data['nguoinop_id'] = Auth::user()->user_id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['gw_id'] = $request->gw_id;
            $data['group_id'] = $request->group_id;
            if ($request->hasFile('sm_file')) {
                $completeFileName = $request->file('sm_file')->getClientOriginalName();
                $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                $extension = $request->file('sm_file')->getClientOriginalExtension();
                $fileNameOnly = str_replace(',', '_', $fileNameOnly);
                $compPic = str_replace(' ', '_', $fileNameOnly) . '_' . rand() . '_' . time() . '.' . $extension;
                $path = $request->file('sm_file')->storeAs('/assets/bainop', $compPic);
                $img_name = $compPic;
                $data['sm_file'] = $img_name;
                $data['sm_typefile'] = $request->sm_typefile;
            }
            submissions::insert($data);
        }
        return response()->json([
            'datasmission'  =>  'thanhcong'
        ]);
    }
    public function edit_submissions(Request $request)
    {
        // unlink($image_path);

    }
    public function delete_submissions(Request $request)
    {
        $bainop = DB::table('submissions')
            ->where('sm_id', '=', $request->idbainop)
            ->first();
            if ($bainop->sm_file) {
                $image_path = 'storage/app/assets/bainop/' . $bainop->sm_file;
                unlink($image_path);
            }
            $bainop = DB::table('submissions')
            ->where('sm_id', '=', $request->idbainop)
            ->delete();
            return back();
        }
        public function chamdiem(Request $request){
            $bainop = DB::table('submissions')
            ->where('sm_id', '=', $request->idbainop)
            ->update([
                'sm_diem'   =>  $request->diem
            ]);
            return response()->json([
                'mess'  =>  'Đã chấm điểm thành công'
            ]);
            

        }
}
