<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\FilePost;
use App\Models\Emoticon;
use App\Models\Friend;

class FriendController extends Controller
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
    public function index()
    {



        return view('make_friend');
    }
    public function load_friend(Request $request)
    {
        $userht = $request->user_id;
        $dsbb = DB::table('users')
            ->join('friend', 'friend.user_from', '=', 'users.user_id')
            ->where('user_to', '=', $request->user_id)
            ->where('f_trangthai', '=', '0')
            ->get();

        if ($dsbb->empty()) {
            $output = '';
        } else {
            $output = '<div class="col-md-12"><h3><b>Yêu cầu kết bạn </b></h3></div>';
        }
        $avatar = '';
        foreach ($dsbb as $bb) {
            if (!empty($bb->avatar)) {
                $avatar = $bb->avatar;
            } else {
                $avatar = 'noteimg.png';
            }
            $output .= '<div class="col-md-3 mt-3">';
            $output .= '<div class="card" style="border-radius:20px;">';
            $output .= '<img src="storage/app/assets/img/avatar/' . $avatar . '" class="card-img-top" style="height: 250px; max-width:100%; object-fit: cover; border-radius:20px 20px 0 0;" alt="...">';
            $output .= '<div class="card-body">';
            $output .= '<a class="text-decoration-none text-dark" href="profile/' . $bb->user_id . '"><h5 class="card-title">' . $bb->firstname . ' ' . $bb->name . '</h5></a>';
            //    $output.=' <p>'.$bb->user_id.'</p>';
            $output .= '<form class="fromxacnhan" id="formxn' . $bb->user_id . '">';
            $output .= '<button type="submit" class="btn btn-primary w-100 btnxacnhan " value="1"  data-userid="' . $bb->user_id . '" data-xacnhan="1">Xác nhận</button>';
            $output .= '<button type="submit" class="btn btn-light mt-2 w-100  btnxacnhan" value="0" data-userid="' . $bb->user_id . '" data-xacnhan="0">Xóa</button>';
            $output .= '</form>';
            $output .= '</div></div></div>';
        }
        $dsbanbe = DB::table('users')
            ->leftjoin('friend', 'friend.user_to', 'users.user_id')
            ->leftjoin('friend as fr', 'fr.user_from', 'users.user_id')
            ->where('users.user_id', '<>', $request->user_id)
            ->select('*', 'fr.user_from as from', 'fr.user_to as to', 'friend.user_from as from2', 'friend.user_to as to2')
            ->get();




        $dsusr = DB::table('users')
            ->where('users.user_id', '<>', $request->user_id)
            ->where('school_id', '=', Auth::user()->school_id)
            ->get();

        $output2 = '';
        $avatar = '';

        foreach ($dsusr as $usr) {
            if (!empty($usr->avatar)) {
                $avatar = $usr->avatar;
            } else {
                $avatar = 'noteimg.png';
            }
            // foreach ($dsbanbe as $kp) {

            $check = DB::table('friend')
                ->where([
                    ['user_from', '=', $usr->user_id],
                    ['user_to', '=', $request->user_id]
                ])
                ->orWhere([
                    ['user_from', '=', $request->user_id],
                    ['user_to', '=', $usr->user_id]
                ])
                ->first();
            // }
            if ($check) {
                // if ($check->user_from != $usr->user_id && $check->user_to != $usr->user_id) {
                //     $output2 .= '<div class="col-md-3 mt-3">';
                //     $output2 .= '<div class="card mt-1" style="border-radius:20px;">';
                //     $output2 .= '<img src="storage/app/assets/img/avatar/' . $avatar . '" class="card-img-top" style="height: 250px; max-width:100%; object-fit: cover; border-radius:20px 20px 0 0;" alt="...">';
                //     $output2 .= '<div class="card-body">';
                //     $output2 .= '<a class="text-decoration-none text-dark" href="profile/' . $usr->user_id . '"><h5 class="card-title">' . $usr->firstname . ' ' . $usr->name . '</h5></a>';
                //     $output2 .= '<form class="fromxacnhan">';
                //     $output2 .= '<button type="submit" class="btn btn-primary w-100 btnketban " value="1"  data-userid="' . $usr->user_id . '" >Kết bạn</button>';
                //     $output2 .= '</form>';
                //     $output2 .= '</div></div></div>';
                // }
            } else {
                // if ($usr->user_id != $request->user_id) {

                $output2 .= '<div class="col-md-3 mt-3">';
                $output2 .= '<div class="card" style="border-radius:20px;">';
                $output2 .= '<img src="storage/app/assets/img/avatar/' . $avatar . '" class="card-img-top" style="height: 250px; max-width:100%; object-fit: cover; border-radius:20px 20px 0 0;" alt="...">';
                $output2 .= '<div class="card-body">';
                $output2 .= '<a class="text-decoration-none text-dark" href="profile/' . $usr->user_id . '"><h5 class="card-title">' . $usr->firstname . ' ' . $usr->name . '</h5></a>';
                $output2 .= '<form class="fromxacnhan">';
                $output2 .= '<button type="submit" class="btn btn-primary w-100 btnketban " value="1"  data-userid="' . $usr->user_id . '" >Kết bạn</button>';
                $output2 .= '</form>';
                $output2 .= '</div></div></div>';
                // }
            }
        }
        return response()->json([
            'output' =>   $output,
            'chuaquen' =>   $output2
        ]);
    }

    public function invitations(Request $request)
    {
        $user_id = $request->user_id;
        $user_from = $request->user_from;
        $xacnhan = $request->xacnhan;
        if ($xacnhan == 0) {
            $delete = DB::table('friend')
                ->where('user_from', '=', $user_from)
                ->where('user_to', '=', $user_id)
                ->delete();
            $output = 'Đã hủy';
        } else if ($xacnhan == 1) {
            $xacnhan = DB::table('friend')
                ->where('user_from', '=', $user_from)
                ->where('user_to', '=', $user_id)
                ->update([
                    'f_trangthai'   =>  '1',
                    'f_ghichu'   =>  'Bạn bè',
                ]);
            $output = 'Bạn bè';
        }
        return response()->json([
            'output' =>   $output

        ]);
    }
    public function send_invitations(Request $request)
    {
        $guiloimoi = new Friend;
        $guiloimoi->user_from = $request->user_from;
        $guiloimoi->user_to = $request->user_to;
        $guiloimoi->f_trangthai = '0';
        $guiloimoi->f_ghichu = 'Đã gửi lời mời';
        $guiloimoi->save();
        return response()->json([
            'ghichu' =>  'Đã gửi lời mời'
        ]);
    }

    public function timquanhday()
    {
        return view('timquanhday');
    }
    public function nearby_friends(Request $request)
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
            if ($user_friend->user_to == Auth::user()->user_id) {
                $datafriends[] = $user_friend->user_from;
            }
            if ($user_friend->user_from == Auth::user()->user_id) {
                $datafriends[] = $user_friend->user_to;
            }
        }

        $listuser = DB::table('users')
            ->where('users.user_id', '<>', Auth::user()->user_id)
            ->whereNotIn('users.user_id', $datafriends)
            // ->orderBy('users.name', 'ASC')
            ->get();

        $update = DB::table('users')
            ->where('user_id', '=', Auth::user()->user_id)
            ->update([
                'latitude'  =>  $request->latitude,
                'longitude'  =>  $request->longitude
            ]);

        $output = '';
        $latitude1 = Auth::user()->latitude;
        $longitude1 = Auth::user()->longitude;
        $datauser = [];
        foreach ($listuser as $users) {
            $latitude2 = $users->latitude;
            $longitude2 = $users->longitude;
            $longi1 = deg2rad($longitude1);
            $longi2 = deg2rad($longitude2);
            $lati1 = deg2rad($latitude1);
            $lati2 = deg2rad($latitude2);
            $difflong = $longi2 - $longi1;
            $difflat = $lati2 - $lati1;
            $val = pow(sin($difflat / 2), 2) + cos($lati1) * cos($lati2) * pow(sin($difflong / 2), 2);
            if (6378.8 * (2 * asin(sqrt($val))) < 50) { //km
                $datauser[] = [
                    'avatar'   =>  $users->avatar,
                    'user_id'   =>  $users->user_id,
                    'firstname'   =>  $users->firstname,
                    'name'   =>  $users->name,
                    'khoangcach' => round(6378.8 * (2 * asin(sqrt($val))), 2)
                ];
            }
        }
        function build_sorter($key)
        {
            return function ($a, $b) use ($key) {
                return strnatcmp($a[$key], $b[$key]);
            };
        }
        usort($datauser, build_sorter('khoangcach'));
        foreach ($datauser as $usersx) {
            if (!empty($usersx['avatar'])) {
                $avatar = $usersx['avatar'];
            } else {
                $avatar = 'noteimg.png';
            }
            $output .= '<div class="col-md-3 mt-3">';
            $output .= '<div class="card" style="border-radius:20px;">';
            $output .= '<img src="storage/app/assets/img/avatar/' . $avatar . '" class="card-img-top" style="height: 250px; max-width:100%; object-fit: cover; border-radius:20px 20px 0 0;" alt="...">';
            $output .= '<div class="card-body">';
            $output .= '<a class="text-decoration-none text-dark pb-0" href="profile/' . $usersx['user_id'] . '"><h5 class="card-title mb-0">' . $usersx['firstname'] . ' ' . $usersx['name'] . '</h5></a>';
            $output .= '<form class="fromxacnhan">';
            $output .= '<span class="text-muted" style="font-size:13px;"> Cách bạn khoảng <b>' . $usersx['khoangcach'] . '</b> km</span>';
            $output .= '<button type="submit" class="btn btn-primary w-100 btnketban " value="1"  data-userid="' . $usersx['user_id'] . '" >Kết bạn</button>';
            $output .= '</form>';
            $output .= '</div></div></div>';
        }
        return response()->json([
            'output'    =>  $output
        ]);
    }
    public function huykb(Request $request)
    {


        $delete = DB::table('friend')
            ->where('user_from', '=', $request->user_from)
            ->where('user_to', '=', $request->user_to)
            ->delete();
        // $output = 'Đã hủy';

        return back();
    }
}
