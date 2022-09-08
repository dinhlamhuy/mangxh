<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\ImgSanPham;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $loaisp = DB::table('loaisanpham')->get();
        $sanpham = DB::table('sanpham')
            ->join('loaisanpham', 'loaisanpham.pl_id', '=', 'sanpham.phanloai')
            ->join('users', 'users.user_id', '=', 'sanpham.nguoiban')
            ->select('*','sanpham.created_at as ngaydangban')
            ->get();
        $imgsanpham = DB::table('imgsanpham')
            // ->join('sanpham', 'sanpham.sp_id', '=', 'imgsanpham.sp_id')
            ->get();
        return view('shop.shop_feed', compact('loaisp', 'sanpham', 'imgsanpham'));
    }
    public function search($tag)
    {
        $loaisp = DB::table('loaisanpham')->get();
        $sanpham = DB::table('loaisanpham')
            ->join('sanpham', 'sanpham.phanloai', '=', 'loaisanpham.pl_id')
            ->join('users', 'users.user_id', '=', 'sanpham.nguoiban')
            ->where('loaisanpham.pl_tag', '=', $tag)
            ->select('*','sanpham.created_at as ngaydangban')
            ->get();
        $imgsanpham = DB::table('imgsanpham')
            // ->join('sanpham', 'sanpham.sp_id', '=', 'imgsanpham.sp_id')
            ->get();
        return view('shop.shop_feed', compact('loaisp', 'sanpham', 'imgsanpham'));
    }
    public function detail($tag, $sp_id)
    {
        $loaisp = DB::table('loaisanpham')->get();
        $sanpham = DB::table('loaisanpham')
            ->join('sanpham', 'sanpham.phanloai', '=', 'loaisanpham.pl_id')
            ->join('users', 'users.user_id', '=', 'sanpham.nguoiban')
            ->where('loaisanpham.pl_tag', '=', $tag)
            ->where('sanpham.sp_id', '=', $sp_id)
            ->select('*','sanpham.created_at as ngaydangban')
            ->first();
        $imgsanpham = DB::table('imgsanpham')
            ->where('sp_id', '=', $sp_id)
            ->get();
        $sanphamlq = DB::table('loaisanpham')
            ->join('sanpham', 'sanpham.phanloai', '=', 'loaisanpham.pl_id')
            ->join('users', 'users.user_id', '=', 'sanpham.nguoiban')
            ->where('sanpham.nguoiban', '=', $sanpham->nguoiban)
            ->where('sanpham.sp_id', '<>', $sanpham->sp_id)
            ->get()->take(3);
        $imgsanphamlq = DB::table('imgsanpham')
            ->get();
        return view('shop.detailsp', compact('loaisp', 'sanpham', 'imgsanpham', 'sanphamlq', 'imgsanphamlq'));
    }
    public function myproduct()
    {
        $loaisp = DB::table('loaisanpham')->get();
        $sanpham = DB::table('loaisanpham')
            ->join('sanpham', 'sanpham.phanloai', '=', 'loaisanpham.pl_id')
            ->join('users', 'users.user_id', '=', 'sanpham.nguoiban')
            ->where('sanpham.nguoiban', '=', Auth::user()->user_id)
            ->select('*','sanpham.created_at as ngaydangban')
            ->get();
        $imgsanpham = DB::table('imgsanpham')
            ->get();
        return view('shop.myproduct', compact('loaisp', 'sanpham', 'imgsanpham'));
    }

    public function add_product(Request $request)
    {
        $sanpham = new SanPham;
        $sanpham->sp_ten = $request->sp_ten;
        $sanpham->sp_gia = $request->sp_gia;
        $sanpham->sp_mota  = $request->sp_mota;
        $sanpham->sp_soluong  = $request->sp_soluong;
        $sanpham->sp_sdt  = $request->sp_sdt;
        $sanpham->sp_tinhtrang  = $request->sp_tinhtrang;
        $sanpham->sp_diachi  = $request->sp_diachi;
        $sanpham->nguoiban  = $request->nguoiban;
        $sanpham->phanloai  = $request->pl_ma;
        $sanpham->save();

        if ($request->hasFile('sp_img')) {
            $dataimg = [];
            foreach ($request->file('sp_img') as $file) {
                $completeFileName = $file->getClientOriginalName();
                $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $compPic = 'SP' . $sanpham->sp_id . '-' . rand() . '-' . time() . '.' . $extension;
                $path = $file->storeAs('/assets/img/product', $compPic);
                $img_name = $compPic;
                $dataimg[] = [
                    'imgsp_ten' =>  $compPic,
                    'sp_id' =>  $sanpham->sp_id,
                ];
            }
            $updateimg = DB::table('imgsanpham')
                ->insert($dataimg);
        }
        return redirect('/shop');
    }
    public function edit_product(Request $request)
    {
        $sanpham = DB::table('sanpham')
            ->where('sp_id', $request->sp_id)
            ->update([
                'sp_ten' => $request->sp_ten,
                'sp_gia' => $request->sp_gia,
                'sp_mota' => $request->sp_mota,
                'sp_soluong' => $request->sp_soluong,
                'sp_sdt' => $request->sp_sdt,
                'sp_tinhtrang' => $request->sp_tinhtrang,
                'sp_diachi' => $request->sp_diachi,
                'phanloai' => $request->pl_ma,

            ]);

        if ($request->hasFile('sp_img')) {
            $old_img = DB::table('imgsanpham')->where('sp_id', '=', $request->sp_id)->get();
            foreach ($old_img as $oldimg) {
                $image_path = 'storage/app/assets/img/product/' . $oldimg->imgsp_ten;
                unlink($image_path);
            }
            $delete_img = DB::table('imgsanpham')->where('sp_id', '=', $request->sp_id)->delete();
            $dataimg = [];
            foreach ($request->file('sp_img') as $file) {
                $completeFileName = $file->getClientOriginalName();
                $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $compPic = 'SP' . $request->sp_id . '-' . rand() . '-' . time() . '.' . $extension;
                $path = $file->storeAs('/assets/img/product', $compPic);
                $img_name = $compPic;
                $dataimg[] = [
                    'imgsp_ten' =>  $compPic,
                    'sp_id' =>  $request->sp_id,
                    'updated_at' =>  date('Y-m-d H:i:s'),
                ];
            }
            $updateimg = DB::table('imgsanpham')
                ->insert($dataimg);
        }
        $loaisp = DB::table('loaisanpham')->get();



        return redirect('/myshop')->with('status', 'Cập nhật thành công!');
    }
    public function delete_product(Request $request)
    {
        
        $delete_sp = DB::table('sanpham')->where('sp_id', '=', $request->sp_id)->delete();
        
        $old_img = DB::table('imgsanpham')->where('sp_id', '=', $request->sp_id)->get();
        foreach ($old_img as $oldimg) {
            $image_path = 'storage/app/assets/img/product/' . $oldimg->imgsp_ten;
            unlink($image_path);
        }
        $delete_img = DB::table('imgsanpham')->where('sp_id', '=', $request->sp_id)->delete();
        return redirect('/myshop')->with('status', 'Xóa sản phẩm thành công!');
    }
    public function pageproduct($user_id){
        
        $nguoiban=DB::table('users')->where('user_id','=',$user_id)->first();
        $thongtinuser=DB::table('sanpham')
        ->join('users','users.user_id','=','sanpham.nguoiban')
        ->join('loaisanpham', 'loaisanpham.pl_id', '=', 'sanpham.phanloai')
        ->where('sanpham.nguoiban','=', $user_id)
        ->select('*','sanpham.created_at as ngaydangban')
        ->get();
        $loaisp = DB::table('loaisanpham')->get();
     
        $imgsanpham = DB::table('imgsanpham')
            // ->join('sanpham', 'sanpham.sp_id', '=', 'imgsanpham.sp_id')
            ->get();
        if($user_id==Auth::user()->user_id){
            return redirect('/myshop');
        }else {
            return view('shop.trangchucuashop', compact('nguoiban','thongtinuser','loaisp','imgsanpham'));

        }


    }
}
