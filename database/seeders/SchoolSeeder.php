<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
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
          'school_name'   =>  'Trường đại học Cần Thơ',
          'school_category'   =>  'Trường đại học',
          'school_address'   =>  'Khu II đường 3/2 Cần Thơ 90000',
          'school_about'   =>  'Đại học Cần Thơ, cơ sở đào tạo đại học và sau đại học trọng điểm của Nhà nước ở ĐBSCL, là trung tâm văn hóa - khoa học kỹ thuật của vùng.<br />Đại học Cần Thơ (ĐHCT), cơ sở đào tạo đại học và sau đại học trọng điểm của Nhà nước ở ĐBSCL, là trung tâm văn hóa - khoa học kỹ thuật của vùng. Hiện Trường đào tạo 98 chuyên ngành đại học (trong đó có 2 chương trình đào tạo tiên tiến, 3 chương trình đào tạo chất lượng cao), 45 chuyên ngành cao học (trong đó 1 ngành liên kết với nước ngoài, 3 ngành đào tạo bằng tiếng Anh), 16 chuyên ngành nghiên cứu sinh.',
          'userql'   =>  '25',
          'school_avatar'   =>  '',
          'school_status'   =>  '1',
          'school_email'   =>  'dhct@ctu.edu.vn',
          'school_phone'   =>  '0292 3832 663',
          'school_link'   =>  'https://www.ctu.edu.vn/',
          'school_background'   =>  '',
          'created_at'  =>  date('Y-m-d H:i:s'),
          'updated_at'  =>  date('Y-m-d H:i:s')

        ];
        $list[]=
        [
          'school_name'   =>  'Trường đại học Cần Thơ (Khu Hòa An)',
          'school_category'   =>  'Trường đại học',
          'school_address'   =>  'Số 554, ấp Hòa Đức, xã Hòa An, huyện Phụng Hiệp, tỉnh Hậu Giang',
          'school_about'   =>  'Khu Hòa An là một cơ sở đào tạo của Trường ĐHCT <br>Sinh viên học tại Khu Hòa An do Khoa Phát triển Nông thôn quản lý và là sinh viên hệ chính quy của Trường Đại học Cần Thơ. Chương trình đào tạo, giảng viên, điều kiện học tập, học phí và bằng cấp hoàn toàn giống như sinh viên học tại thành phố Cần Thơ. Khi trúng tuyển những sinh viên này sẽ học năm thứ nhất và năm thứ 4 tại thành phố Cần Thơ, các năm học còn lại học tại Khu Hòa An.',
          'userql'   =>  '26',
          'school_avatar'   =>  '',
          'school_status'   =>  '1',
          'school_email'   =>  'dhct@ctu.edu.vn',
          'school_phone'   =>  '0292 3832 663',
          'school_link'   =>  'https://www.ctu.edu.vn/',
          'school_background'   =>  'noteimg.png',
          'created_at'  =>  date('Y-m-d H:i:s'),
          'updated_at'  =>  date('Y-m-d H:i:s')

        ];
        $list[]=
        [
          'school_name'   =>  'Trường Cao đẳng Cần Thơ',
          'school_category'   =>  'Trường cao đẳng',
          'school_address'   =>  'Số 413, Đường 30/4, Phường Hưng Lợi, Quận Ninh Kiều, TP. Cần Thơ',
          'school_about'   =>  'Được thành lập từ năm 1976, tọa lạc tại trung tâm thành phố Cần Thơ, với diện tích hơn 60.000 m2. Trường có 80 phòng học, hệ thống giảng đường, phòng thí nghiệm thực hành; nhà tập đa năng, sân chơi, khu ký túc xá sinh viên… hiện có và đang được xây dựng thêm sẽ góp phần đáp ứng như cầu học tập, sinh hoạt và rèn luyện sức khỏe của học sinh sinh viên vì ngày mai “lập thân, lập nghiệp”.',
          'userql'   =>  '27',
          'school_avatar'   =>  '',
          'school_status'   =>  '1',
          'school_email'   =>  'cdct@ctu.edu.vn',
          'school_phone'   =>  '0292 3838 306',
          'school_link'   =>  'https://www.ctu.edu.vn/',
          'school_background'   =>  'noteimg.png',
          'created_at'  =>  date('Y-m-d H:i:s'),
          'updated_at'  =>  date('Y-m-d H:i:s')
        ];
     
        DB::table('school')->insert($list);
    }
}
