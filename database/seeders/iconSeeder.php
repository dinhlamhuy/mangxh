<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class iconSeeder extends Seeder
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
          'icon_symbol'   =>  'like',
          'icon_name'   =>  'Thích',
       
        ];
        $list[]=
        [
          'icon_symbol'   =>  'love',
          'icon_name'   =>  'Yêu thích',
       
        ];
        $list[]=
        [
          'icon_symbol'   =>  'haha',
          'icon_name'   =>  'Ha ha',
       
        ];
        $list[]=
        [
            'icon_symbol'   =>  'sad',
            'icon_name'   =>  'Buồn bã',
            
        ];
        $list[]=
        [
          'icon_symbol'   =>  'wow',
          'icon_name'   =>  'Ngạc nhiên',
       
        ];
        $list[]=
        [
          'icon_symbol'   =>  'angry',
          'icon_name'   =>  'Giận dữ',
       
        ];
        DB::table('icon')->insert($list);

    }
}
