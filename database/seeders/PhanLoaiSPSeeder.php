<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PhanLoaiSPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        $list[]=
        [
          'pl_ten'   =>  'Sách',
          'pl_icon'   =>  '<i class="fa fa-book" aria-hidden="true"></i>',
          'pl_tag'    =>  'sach'
        ];
        $list[]=
        [
          'pl_ten'   =>  'Dụng cụ học tập',
          'pl_icon'   =>  '<i class="fa fa-scissors" aria-hidden="true"></i>',
          'pl_tag'    =>  'dung_cu_hoc_tap'
        ];
        $list[]=
        [
          'pl_ten'   =>  'Thời trang',
          'pl_icon'   =>  '<i class="fa fa-briefcase" aria-hidden="true"></i>',
          'pl_tag'    =>  'thoi_trang'
        ];
        $list[]=
        [
          'pl_ten'   =>  'Dụng cụ thể thao',
          'pl_icon'   =>  '<i class="fa fa-futbol-o" aria-hidden="true"></i>',
          'pl_tag'    =>  'dung_cu_the_thao'
        ];
        $list[]=
        [
          'pl_ten'   =>  'Khác',
          'pl_icon'   =>  '<i class="fa fa-hashtag" aria-hidden="true"></i>',
          'pl_tag'    =>  'khac'
        ];
        DB::table('loaisanpham')->insert($list);
    }
}
