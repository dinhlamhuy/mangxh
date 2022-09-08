<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\FilePost;
use App\Models\comment;

class UploadPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {

        $baidang = DB::table('users')
            ->join('posts', 'users.user_id', '=', 'posts.user_id')
            ->select('users.*', 'posts.*')
            ->where('posts.category_post', '=', '1')
            ->orderBy('post_id', 'DESC')
            ->get();

        $imgbaidang = DB::table('posts')
            ->join('file_post', 'file_post.post_id', '=', 'posts.post_id')
            ->select('file_post.*', 'posts.*')
            ->orderBy('posts.post_id', 'DESC')
            ->get();
        return view('home', compact('baidang', 'imgbaidang'));
    }


    public function store(Request $request)
    {
        $status = '';
        if ($request->status == 'Công khai') {
            $status = '<i class="fa fa-globe" aria-hidden="true"></i>';
        } else if ($request->status == 'Bạn bè') {
            $status = '<i class="fa fa-user" aria-hidden="true"></i>';
        } else if ($request->status == 'Riêng tư') {
            $status = '<i class="fa fa-lock" aria-hidden="true"></i>';
        }

        if (!empty($request->school_id)) {
            $duyet = $request->post_choduyet;
        } else {
            $duyet = '1';
        }
        $post = new Post;
        $post->caption = $request->caption;
        $post->post_choduyet = $duyet;
        $post->status = $request->status;
        $post->user_id  = $request->userid;
        $post->sharepost_id  = $request->post_id;
        $post->type_post  = $request->type_post;
        $post->group_id  = $request->group_id;
        $post->school_id  = $request->school_id;
        $post->category_post  = $request->category_post;
        $post->save();

        $img = [];
        $imgtype = [];
        if ($request->TotalImages > 0) {
            $filepost = new FilePost;
            for ($x = 0; $x < $request->TotalImages; $x++) {
                if ($request->hasFile('imgpost' . $x)) {
                    $post_id = $post->post_id;
                    $img_type = $request->imgpost_type;
                    $completeFileName = $request->file('imgpost' . $x)->getClientOriginalName();
                    $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                    $extension = $request->file('imgpost' . $x)->getClientOriginalExtension();
                    $fileNameOnly = str_replace(',', '_', $fileNameOnly);
                    $compPic = str_replace(' ', '_', $fileNameOnly) . '_' . rand() . '_' . time() . '.' . $extension;
                    $path = $request->file('imgpost' . $x)->storeAs('/assets/img/baidang', $compPic);
                    $img_name = $compPic;
                    $insert[$x]['post_id'] = $post_id;
                    $insert[$x]['img_type'] = $img_type;
                    $insert[$x]['img_name'] = $img_name;
                    $img[] = $compPic;
                    $imgtype[] = $img_type;
                }
            }
            filepost::insert($insert);
        }
        return response()->json([
            'img'  =>  $img,
            'imgtype'  =>  $imgtype,
            'caption'  =>  $request->caption,

            'userid'  =>  $request->userid,
            'postid'  =>  $post->post_id,
            'status'  =>  $status,
        ]);
    }


    public function comment(Request $request)
    {
        $cmt = new comment;
        $cmt->cmt_noidung = $request->cmt_noidung;
        $cmt->cmt_reply = $request->cmt_reply;
        // $cmt->cmt_hinhanh=$request->cmt_hinhanh;
        $cmt->user_id = $request->userid;
        $cmt->post_id = $request->post_id;
        $cmt->save();

        $finduser = DB::table('users')
            ->where('user_id', '=', $request->userid)
            ->first();
        return response()->json([
            'post_id'  =>  $request->post_id,
            'user_id'  =>  $request->userid,
            'firstname'  =>  $finduser->firstname,
            'name'  =>  $finduser->name,
            'date'  =>  date('d/m/Y', strtotime(date('Y-m-d'))),
            'cmt_noidung'  =>  $request->cmt_noidung
        ]);
    }





    public function editpost(Request $request)
    {


        $update = DB::table('posts')->where('post_id', '=', $request->post_id)->update([
            'caption'   =>  $request->caption,
            'status'   =>  $request->status
        ]);

        $dataimg = [];
        $img = [];
        $imgtype = [];
        if ($request->hasFile('imgpost')) {
            $old_img = DB::table('file_post')->where('post_id', '=', $request->post_id)->get();
            foreach ($old_img as $oldimg) {
                $image_path = 'storage/app/assets/img/baidang/' . $oldimg->img_name;
                unlink($image_path);
            }
            $delete_img = DB::table('file_post')->where('post_id', '=', $request->post_id)->delete();
            if ($request->TotalImages > 0) {
                $filepost = new FilePost;
                for ($x = 0; $x < $request->TotalImages; $x++) {
                    if ($request->hasFile('imgpost' . $x)) {
                        $post_id = $request->post_id;
                        $img_type = $request->imgpost_type;
                        $completeFileName = $request->file('imgpost' . $x)->getClientOriginalName();
                        $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                        $extension = $request->file('imgpost' . $x)->getClientOriginalExtension();
                        $fileNameOnly = str_replace(',', '_', $fileNameOnly);
                        $compPic = str_replace(' ', '_', $fileNameOnly) . '_' . rand() . '_' . time() . '.' . $extension;
                        $path = $request->file('imgpost' . $x)->storeAs('/assets/img/baidang', $compPic);
                        $img_name = $compPic;
                        $insert[$x]['post_id'] = $post_id;
                        $insert[$x]['img_type'] = $img_type;
                        $insert[$x]['img_name'] = $img_name;
                        $img[] = $compPic;
                        $imgtype[] = $img_type;
                    }
                }
                filepost::insert($insert);
            }
           
        }
        return response()->json([
            'img'  =>  $img,
            'imgtype'  =>  $imgtype,
            'caption'  =>  $request->caption,

            'userid'  =>  $request->userid,
            'postid'  =>  $request->post_id,
            'status'  =>  $request->status,
        ]);
    }
}
