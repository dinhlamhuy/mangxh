<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

session_start();

class AdminController extends Controller
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
    public function index()
    {
        return view('admin.login');
    }
    public function dangnhapadmin(Request $request)
    {
        // $this->AuthLogin();
        $acc = $request->ad_acc;
        $pass = md5($request->ad_pass);
        $result = DB::table('admin')->where('ad_account', '=', $acc)->where('ad_password', '=', $pass)->first();
        if ($result) {
            Session::put('ad_account', $result->ad_account);
            Session::put('ad_ma', $result->ad_ma);
            return Redirect::to('admin/dashboard');
        } else {
            Session::put('ad_mess', 'Mật khẩu bị sai!');
            return Redirect::to('admin/login');
        }
    }

    public function admindoimk()
    {
        $this->AuthLogin();

        return view('admin.doimk');
    }
    public function doimk(Request $request)
    {
        $checkpass = DB::table('admin')->where('ad_ma', '=', $request->ad_ma)->where('ad_password', '=', md5($request->old_pass))->first();
        if ($checkpass) {
            if ($request->new_pass == $request->xnnew_pass) {
                $update = DB::table('admin')->where('ad_ma', '=', $checkpass->ad_ma)
                    ->update([
                        'ad_password'   =>  md5($request->new_pass),
                    ]);
                return Redirect::to('admin/dashboard')->with('tbaomk', 'Thay đổi thành công');
            } else {
                return Redirect::to('admin/admindoimk')->with('tbaomk', 'Xác nhận mật khẩu không trùng khớp');
            }
        } else {
            return Redirect::to('admin/admindoimk')->with('tbaomk', 'Mật khẩu cũ không đúng vui lòng nhập lại');
        }
    }

    public function logout()
    {
        Session::put('ad_account', null);
        Session::put('ad_ma', null);
        return Redirect::to('admin/login');
    }






    //USER
    public function qluser()
    {
        $this->AuthLogin();
        $listusr = DB::table('users')->leftjoin('school', 'school.school_id', '=', 'users.school_id')
            ->select('users.*', 'school.*', 'users.created_at as ngaythamgia')
            ->get();
        return view('admin.qluser', compact('listusr'));
    }
    public function qluserhs()
    {
        $this->AuthLogin();
        $listusr = DB::table('users')
            ->leftjoin('school', 'school.school_id', '=', 'users.school_id')
            ->where('users.job', 'LIKE', '%Học sinh%')
            ->select('users.*', 'school.*', 'users.created_at as ngaythamgia')
            ->get();
        return view('admin.qluser', compact('listusr'));
    }
    public function qlusersv()
    {
        $this->AuthLogin();
        $listusr = DB::table('users')
            ->leftjoin('school', 'school.school_id', '=', 'users.school_id')
            ->where('users.job', 'LIKE', '%Sinh viên%')
            ->select('users.*', 'school.*', 'users.created_at as ngaythamgia')
            ->get();
        return view('admin.qluser', compact('listusr'));
    }
    public function qluserkhac()
    {
        $this->AuthLogin();
        $listusr = DB::table('users')
            ->leftjoin('school', 'school.school_id', '=', 'users.school_id')
            ->where('users.job', 'not like', '%Sinh viên%')
            ->where('users.job', 'not LIKE', '%Học sinh%')
            ->select('users.*', 'school.*', 'users.created_at as ngaythamgia')
            ->get();
        return view('admin.qluser', compact('listusr'));
    }

    //FANPAGE SCHOOL
    public function qltrang()
    {
        $this->AuthLogin();
        $listschool = DB::table('school')->join('users', 'users.user_id', '=', 'school.userql')
            ->where('school.school_status', '=', '1')
            ->select('users.*', 'school.*', 'school.created_at as ngaythanhlap')
            ->get();
        $sltheodoi = DB::table('school')->join('school_followers', 'school_followers.school_id', '=', 'school.school_id')
            ->where('school.school_status', '=', '1')
            ->count();

        return view('admin.dstrang', compact('listschool', 'sltheodoi'));
    }
    public function qltrangchoduyet()
    {
        $this->AuthLogin();
        $listschool = DB::table('school')->join('users', 'users.user_id', '=', 'school.userql')
            ->where('school.school_status', '=', '2')
            ->select('users.*', 'school.*', 'school.created_at as ngaythanhlap')
            ->get();
        return view('admin.dstrangchoduyet', compact('listschool'));
    }
    public function duyettrang(Request $request)
    {
        $this->AuthLogin();
        $listschool = DB::table('school')
            ->where('school.school_id', '=', $request->school_id)
            ->update([
                'school.school_status'    =>    '1'
            ]);

        return Redirect('admin/schoolchoduyet')->with('tbduyettrang', 'Đã duyệt trang thành công');
    }

    //NHÓM
    public function dsnhom()
    {
        $this->AuthLogin();
        $listgroup = DB::table('group')
            ->join('users', 'users.user_id', '=', 'group.group_founder')
            ->select('users.*', 'group.*', 'group.created_at as ngaylap')
            ->get();
        return view('admin.dsnhom', compact('listgroup'));
    }

    //BÀI ĐĂNG
    public function qlbaidang()
    {
        $this->AuthLogin();
        $listpost = DB::table('posts')
            ->join('users', 'users.user_id', '=', 'posts.user_id')
            ->where('posts.post_choduyet', '=', '1')
            ->select('users.*', 'posts.*', 'posts.created_at as ngaydang')
            ->orderBy('post_id', 'DESC')
            ->get();
        return view('admin.qlbaidang', compact('listpost'));
    }
    public function dsbaidangvipham()
    {
        $this->AuthLogin();
        $listpost = DB::table('posts')
            ->join('baocaopost', 'baocaopost.post_id', '=', 'posts.post_id')
            ->join('users', 'users.user_id', '=', 'baocaopost.user_tocao')
            ->select('users.*', 'posts.*', 'baocaopost.*', 'posts.created_at as ngaydang', 'baocaopost.created_at as ngaytocao')
            ->orderBy('ngaytocao', 'DESC')
            ->get();
        return view('admin.qlbaidangreport', compact('listpost'));
    }

    public function dsuservipham()
    {
        $this->AuthLogin();
        $list = DB::table('users')
            ->join('baocaovipham', 'baocaovipham.user_id', '=', 'users.user_id')
            ->join('users as usr', 'usr.user_id', '=', 'baocaovipham.user_tocao')
            ->select('users.*', 'usr.*', 'baocaovipham.*', 'baocaovipham.created_at as ngaytocao')
            // ->orderBy('user_id', 'ASC')
            ->get();
        return view('admin.qluservipham', compact('list'));
    }
    public function dsgroupvipham()
    {
        $this->AuthLogin();
        $list = DB::table('group')
            ->join('baocaovipham', 'baocaovipham.group_id', '=', 'group.group_id')
            ->join('users', 'users.user_id', '=', 'baocaovipham.user_tocao')
            ->select('users.*', 'group.*', 'baocaovipham.*', 'baocaovipham.created_at as ngaytocao')
            ->get();
        return view('admin.qlgroupvipham', compact('list'));
    }
    public function dsschoolvipham()
    {
        $this->AuthLogin();
        $list = DB::table('school')
            ->join('baocaovipham', 'baocaovipham.school_id', '=', 'school.school_id')
            ->join('users', 'users.user_id', '=', 'baocaovipham.user_tocao')
            ->select('users.*', 'school.*', 'baocaovipham.*', 'baocaovipham.created_at as ngaytocao')
            ->get();
        return view('admin.qlschoolvipham', compact('list'));
    }










    public function dashboard()
    {
        $this->AuthLogin();
        $totalusr = DB::table('users')->count();
        $totalgroup = DB::table('group')->count();
        $totalschool = DB::table('school')->count();
        $totalmessage_groups = DB::table('message_groups')->count();
        $totalposts = DB::table('posts')->count();
        $totalfriend = DB::table('friend')->count();


        $listschool = DB::table('school')
            ->join('school_followers', 'school_followers.school_id', '=', 'school.school_id')
            ->select(DB::raw('count(*) as soluottheodoi', 'school_name'))
            ->groupBy('school.school_id')
            ->get();

        $hs = DB::table('users')->where('users.job', 'LIKE', '%Học sinh%')->count();
        $sv = DB::table('users')->where('users.job', 'LIKE', '%Sinh viên%')->count();


        $posttheothang = DB::table("posts")
        ->select(DB::raw("MONTH(created_at) as thang")  ,DB::raw("(COUNT(*)) as slpost"))
            ->orderBy('created_at')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();
       

        return view('admin.dashboard', compact('totalusr', 'totalgroup', 'totalschool', 'totalmessage_groups', 'totalposts', 'totalfriend', 'listschool', 'hs', 'sv' ,'posttheothang'));
    }
}
