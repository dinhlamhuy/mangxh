<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        // $list[]=
        // [
        //   'firstname'   =>  'Admin',
        //   'name'   =>  'Admin',
        //   'email'   =>  'admin@gmail.com',
        //   'sex'   =>  'Nam',
        //   'avatar'   =>  '',
        //   'job'   =>  'Quản trị viên',
        //   'class'   =>  '',
        //    'school_id'   =>  null,
        //   'interests'   =>  '',
        //   'address'   =>  'Sóc Trăng',
        //   'birthday'   =>  '1999-12-07',
        //   'latitude'  =>  '10.027153',
        //    'longitude'  =>  '105.770185',
        //   'password'   =>  Hash::make('12345678'),
        //   'created_at'  =>  date('Y-m-d H:i:s')

        // ];
        $list[]=
        [
          'firstname'   =>  'Nguyễn',
          'name'   =>  'Hoàng Long',
          'email'   =>  'nguyenhoanglong@gmail.com',
          'sex'   =>  'Nam',
          'avatar'   =>  '',
          'job'   =>  'Sinh Viên',
          'class'   =>  '',
           'school_id'   =>  null,
          'interests'   =>  '',
          'address'   =>  'Cù Lao Dung Sóc Trăng',
          'birthday'   =>  '2000-01-01',
          'latitude'  =>  '10.027153',
           'longitude'  =>  '105.770185',
          'password'   =>  Hash::make('12345678'),
          'created_at'  =>  date('Y-m-d H:i:s')

        ];
        $list[]=
        [
           'firstname'  =>  'Đinh',
           'name'  =>  'Lâm Huy',
           'email'  =>  'dinhlamhuytak489@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Mỹ Tú, Sóc Trăng',
           'birthday'  =>  '2000-01-01',
           'latitude'  =>  '10.028220',
           'longitude'  =>  '105.769616',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Đinh',
           'name'  =>  'Tuấn Hoàng',
           'email'  =>  'dinhtuanhoangtak489@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cù Lao Dung, Sóc Trăng',
           'birthday'  =>  '2000-01-01',
           'latitude'  =>  '10.027829',
           'longitude'  =>  '105.770598',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Nguyễn',
           'name'  =>  'Văn Tý',
           'email'  =>  'nguyenvanty@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  => null,
           'interests'  =>  '',
           'address'  =>  'Châu đốc, An Giang',
           'birthday'  =>  '2001-01-12',
           'latitude'  =>  '10.029720',
           'longitude'  =>  '105.772577',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Phạm',
           'name'  =>  'Thiên Phúc',
           'email'  =>  'phamthienphuc@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cao Lãnh, Bến Tre',
           'birthday'  =>  '2002-01-01',
           'latitude'  =>  '10.029287',
           'longitude'  =>  '105.771869',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Mai',
           'name'  =>  'Quốc Hưng',
           'email'  =>  'maiquochung@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cao Lãnh, Bến Tre',
           'birthday'  =>  '2002-01-01',
           'latitude'  =>  '10.037982',
           'longitude'  =>  '105.776670',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Phan',
           'name'  =>  'Nhất Long',
           'email'  =>  'phannhatlong@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Ninh Kiều, Cần Thơ',
           'birthday'  =>  '2002-01-01',
           'latitude'  =>  '10.022588',
           'longitude'  =>  '105.762136',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Ngô',
           'name'  =>  'Bảo Long',
           'email'  =>  'ngobaolong@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cao Lãnh, Bến tre',
           'birthday'  =>  '2002-01-01',
           'latitude'  =>  '10.022715',
           'longitude'  =>  '105.761836',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Ngô',
           'name'  =>  'Bảo Thiên',
           'email'  =>  'ngobaothien@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cao Lãnh, Bến tre',
           'birthday'  =>  '2002-01-01',
           'latitude'  =>  '10.022715',
           'longitude'  =>  '105.761836',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Nguyễn',
           'name'  =>  'Hồng Ngọc',
           'email'  =>  'nguyenhongngoc@gmail.com',
           'sex'  =>  'Nữ',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cao Lãnh, Bến tre',
           'birthday'  =>  '2004-11-01',
           'latitude'  =>  '10.022715',
           'longitude'  =>  '105.761836',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Đinh',
           'name'  =>  'Mỹ Kiều',
           'email'  =>  'dinhmykieu@gmail.com',
           'sex'  =>  'Nữ',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'Sinh Viên',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cao Lãnh, Bến tre',
           'birthday'  =>  '2001-11-09',
           'latitude'  =>  '10.022715',
           'longitude'  =>  '105.761836',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Phạm',
           'name'  =>  'Thị Diễm',
           'email'  =>  'phamthidiem@gmail.com',
           'sex'  =>  'Nữ',
           'avatar'  =>  'noteimg.png',
           'job'  =>  'học sinh',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cao Lãnh, Bến tre',
           'birthday'  =>  '1998-02-11',
           'latitude'  =>  '10.022715',
           'longitude'  =>  '105.761836',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Hoàng',
           'name'  =>  'Thùy Lâm',
           'email'  =>  'hoangthuylam@gmail.com',
           'sex'  =>  'Nữ',
           'avatar'  =>  'noteimg.png',
           'job'  =>  '',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Trà Vinh',
           'birthday'  =>  '2002-05-12',
           'latitude'  =>  '10.022715',
           'longitude'  =>  '105.761836',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        $list[]=
        [
           'firstname'  =>  'Phạm',
           'name'  =>  'Ngọc Thạch',
           'email'  =>  'phamngocthach@gmail.com',
           'sex'  =>  'Nam',
           'avatar'  =>  'noteimg.png',
           'job'  =>  '',
           'class'  =>  '',
            'school_id'  =>  null,
           'interests'  =>  '',
           'address'  =>  'Cao Lãnh, Bến tre',
           'birthday'  =>  '2010-11-11',
           'latitude'  =>  '10.022715',
           'longitude'  =>  '105.761836',
           'password'  =>  Hash::make('12345678'),
            'created_at'  =>  date('Y-m-d H:i:s')
        ];
        
        DB::table('users')->insert($list);
    }
}
