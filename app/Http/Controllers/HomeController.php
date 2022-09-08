<?php

namespace App\Http\Controllers;

use App\Models\baocaopost;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\FilePost;
use App\Models\Emoticon;
use App\Models\Comment;
use App\Models\baocaovipham;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }
    public function doimkusr( Request $request){
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Mật khẩu cũ không đúng. Vui lòng nhập lại!");
        }

        if(strcmp($request->new_confirm_password, $request->new_password) != 0){
         
            return redirect()->back()->with("error","Xác nhận mật khẩu không trùng khớp.");
        }
     
        $update=DB::table('users')
        ->where('user_id','=',Auth::user()->user_id)
        ->update([
            'password'  =>  bcrypt($request->new_password)
        ]);

        return redirect()->back()->with("success","Thay đổi mật khẩu thành công !");
        // return view('auth.changepassword');
    }
    public function index()
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

        // $groupmem = DB::table('group_members')
        //     ->join('group', 'group.group_id', '=', 'group_members.group_id')
        //     ->join('users', 'users.user_id', '=', 'group_members.user_id')
        //     ->where('group_members.user_id', Auth::user()->user_id)
        //     ->select('*')
        //     ->get();
        //     $arrgroup=[];
        //     foreach ($groupmem as $gr) {
        //         $arrgroup[]=$gr->group_id;
        //     }

        $friends = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereIn('users.user_id', $datafriends)
            ->get();
            $datafriends[]=[Auth::user()->user_id];
        $baidang = DB::table('posts')
            ->leftJoin('group', 'group.group_id', '=', 'posts.group_id')
            // ->leftjoin('group', function ($join) {
            //     $join->on('posts.group_id', '=', 'group.group_id')
            //     ->whereIn('group.group_id', $arrgroup);
            // })
            // ->leftjoin('school', function ($join) {
            //     $join->on('posts.school_id', '=', 'school.school_id')
            //     ->where('school.school_id', '=', '2');
            // })
            ->leftJoin('school', 'school.school_id', '=', 'posts.school_id')
            ->join('users', 'users.user_id', '=', 'posts.user_id')
            ->select('users.*', 'posts.*', 'posts.created_at as ngaydang', 'group.*', 'school.*', 'school.school_id as idschool')
            ->orderBy('post_id', 'DESC')
            // ->where('school.school_id', '=', '2')
            ->whereIn('users.user_id', $datafriends)
            ->where('post_choduyet', '=', '1')
            ->whereIn('posts.status',  ['Công khai','Bạn bè'])
            ->get();
       



        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            // ->where('posts.type_post','=','1')
            ->where('posts.status', '=', 'Công khai')
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

            $groups = DB::table('message_group_members')
            ->join('message_groups', 'message_groups.id', '=', 'message_group_members.message_group_id')
            ->join('users', 'users.user_id', '=', 'message_group_members.user_id')
            ->where('message_group_members.user_id', Auth::user()->user_id)
            ->select('*', 'message_groups.name as groupname')
            ->get();


        return view('home', compact('baidang', 'imgbaidang', 'emoticons', 'slicon', 'friends', 'groups','icon'));
    }
    public function release_emotions(Request $request)
    {
        $sl = '';
        // $token = $request->session()->token();
        $imgicon = '';
        global $emoticons;
        $emoticons = DB::table('emoticons')
            ->where('emoticons.post_id', $request->post)
            ->where('emoticons.user_id', Auth::user()->user_id)
            ->first();

        if ($emoticons) {
            DB::table('emoticons')->where('emoticons_id', '=', $emoticons->emoticons_id)->delete();
            if (!empty($request->onoff)) {
                $imgicon = '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thích';
                $sl = '-1';
            } else {

                $icon = new Emoticon;
                $icon->emoticons_id = $emoticons->emoticons_id;
                $icon->icon_id = $request->iconid;
                // $icon->emoticons_name = $request->comment;
                $icon->post_id = $request->post;
                $icon->user_id =Auth::user()->user_id;
                $icon->save();
                $imgicon = '<img src="http://localhost/mangxh/storage/app/assets/img/icon/' . $request->icon . '.png" style="height: 20px; width:20px; border-radius: 50%;" > ' . $request->comment;
            }
        } else {
            $sl = '1';

            $icon = new Emoticon;
            // $icon->emoticons_symbol = $request->icon;
            $icon->icon_id = $request->iconid;
            // $icon->emoticons_name = $request->comment;
            $icon->post_id = $request->post;
            $icon->user_id = Auth::user()->user_id;
            $icon->save();
            $imgicon = '<img src="http://localhost/mangxh/storage/app/assets/img/icon/' . $request->icon . '.png" style="height: 20px; width:20px; border-radius: 50%;" > ' . $request->comment;
        }
        return response()->json([
            'emotions' =>   $imgicon,
            'userid' =>   Auth::user()->user_id,
            'post' =>   $request->post,
            'sl'    =>  $sl
        ]);
    }

    public function posts($id)
    {
        $post = DB::table('posts')
            ->leftJoin('group', 'group.group_id', '=', 'posts.group_id')
            ->leftJoin('school', 'school.school_id', '=', 'posts.school_id')
            ->join('users', 'users.user_id', '=', 'posts.user_id')
            ->where('post_id', '=', $id)
            ->where('post_choduyet', '=', '1')
            ->first();
            

            if(empty($post->post_id)){
                return view('empty');
            }else {
                
    
                $postid=$post->post_id;
                $chupost='';
                if(!empty($post->sharepost_id)){
                    $postid=$post->sharepost_id;
                    $chupost=DB::table('posts')
                    ->leftJoin('group', 'group.group_id', '=', 'posts.group_id')
                    ->leftJoin('school', 'school.school_id', '=', 'posts.school_id')
                    ->join('users', 'users.user_id', '=', 'posts.user_id')
                    ->where('post_id', '=', $postid)
                    ->first();;
                }
    
                
            $imgbaidang = DB::table('posts')
                ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
                ->where('file_post.post_id', '=', $postid)
                ->select('file_post.*', 'posts.*')
                ->orderBy('posts.post_id', 'DESC')
                ->get();
    
            $icon = DB::table('icon')->get();
            $emoticons = DB::table('emoticons')
            ->join('icon','icon.icon_id','=','emoticons.icon_id')
            ->Where('emoticons.post_id', '=', $id)
            ->get();
    
            $slicon = DB::table('emoticons')
            ->join('icon','icon.icon_id','=','emoticons.icon_id')
            ->Where('post_id', '=', $id)
                ->select(DB::raw('count(*) as bieucam, post_id', 'icon_symbol'))
                ->groupBy('post_id')
                ->get();
    
    
            $counttt = DB::table('emoticons')
                ->Where('post_id', '=', $id)->count();
            $countshare = DB::table('posts')
                ->Where('sharepost_id', '=', $id)->count();
            $comment = DB::table('comment')
                ->join('users', 'users.user_id', '=', 'comment.user_id')
                ->join('posts', 'posts.post_id', '=', 'comment.post_id')
                ->where('comment.post_id', '=', $id)
                ->whereNull('comment.cmt_reply')
                ->select('*', 'comment.user_id as user_cmt')
                ->get();
            $comment_reply = DB::table('comment')
                ->join('users', 'users.user_id', '=', 'comment.user_id')
                ->join('posts', 'posts.post_id', '=', 'comment.post_id')
                ->where('comment.post_id', '=', $id)
                ->whereNotNull('comment.cmt_reply')
                ->select('*', 'comment.user_id as user_cmt')
                ->get();
                return view('detailpost', compact('post', 'imgbaidang', 'slicon', 'emoticons','icon', 'comment', 'counttt', 'countshare', 'comment_reply','chupost'));

            }
    }


    public function searchfriend(Request $request) {
        $tk = $request->search;
        $user = DB::table('users')
            ->whereRaw("concat(firstname, ' ', name) like '%" .$tk. "%' ")
            ->orwhere('users.name', 'LIKE', '%' . $tk . '%')
            ->orWhere('users.firstname', 'LIKE', '%' . $tk . '%')
            // ->orWhere('CONCAT(firstname, name)', 'LIKE', '%' . $tk . '%')
            ->get();
        $schools = DB::table('school')
        ->where('school_status', '=', '1')
            ->where('school_name', 'LIKE', '%'.$tk .'%')
            ->orwhere('school_category', 'LIKE', '%'.$tk .'%')
            ->get();
        $groups = DB::table('group')
            ->where('group_name', 'LIKE', '%' . $tk . '%')
            ->get();
        return view('search', compact('user', 'groups', 'schools'));
    }
    public function savedpost(Request $request) {
        $saved = new Bookmark;
        $saved->nguoiluu = $request->user_id;
        $saved->baiviet = $request->post_id;
        $saved->created_at = date('Y-m-d H:i:s');
        $saved->updated_at = date('Y-m-d H:i:s');
        $saved->save();
        
    }
    public function cancelpost(Request $request)
    {
       $xoa=DB::table('bookmark')->where('bm_id','=',$request->bm_id)->delete();
       return response()->json([
        'bm_id'    =>  'bookmark'.$request->bm_id
        ]);
    }
    public function saved() {
        $listsaved=DB::table('bookmark')
        ->join('posts','posts.post_id','=','bookmark.baiviet')
        ->join('users','users.user_id','=','posts.user_id')
        ->leftJoin('group', 'group.group_id', '=', 'posts.group_id')
        ->leftJoin('school', 'school.school_id', '=', 'posts.school_id')
        ->select('bookmark.*','users.*', 'posts.*', 'posts.created_at as ngaydang', 'group.*', 'school.*', 'school.school_id as idschool','bookmark.created_at as ngayluu')
        ->where('nguoiluu','=',Auth::user()->user_id)->get();
       return view('dsdaluu',compact('listsaved'));

    }
    public function baocao(Request $request){
        $tocao=new baocaopost;
        $tocao->user_tocao=Auth::user()->user_id;
        $tocao->rp_tieude=$request->rp_tieude;
        $tocao->rp_noidung=$request->rp_noidung;
        $tocao->post_id=$request->post_id;
        $tocao->save();
        return response()->json([
            'nd'    =>  'thành công'
        ]);
    }
    public function baocaousr(Request $request){
        $tocao=new baocaovipham;
        $tocao->user_tocao=Auth::user()->user_id;
        $tocao->bcvp_tieude=$request->bcvp_tieude;
        $tocao->bcvp_noidung=$request->bcvp_noidung;
        $tocao->user_id=$request->user_id;
        $tocao->bcvp_catory='1';
        $tocao->save();
        return response()->json([
            'nd'    =>  'Báo cáo vi phạm thành công'
        ]);
    }
    public function baocaogroup(Request $request){
        $tocao=new baocaovipham;
        $tocao->user_tocao=Auth::user()->user_id;
        $tocao->bcvp_tieude=$request->bcvp_tieude;
        $tocao->bcvp_noidung=$request->bcvp_noidung;
        $tocao->group_id=$request->group_id;
        $tocao->bcvp_catory='2';
        $tocao->save();
        return response()->json([
            'nd'    =>  'Báo cáo vi phạm thành công'
        ]);
    }
    public function baocaoschool(Request $request){
        $tocao=new baocaovipham;
        $tocao->user_tocao=Auth::user()->user_id;
        $tocao->bcvp_tieude=$request->bcvp_tieude;
        $tocao->bcvp_noidung=$request->bcvp_noidung;
        $tocao->school_id=$request->school_id;
        $tocao->bcvp_catory='3';
        $tocao->save();
        return response()->json([
            'nd'    =>  'Báo cáo vi phạm thành công'
        ]);
    }




}
