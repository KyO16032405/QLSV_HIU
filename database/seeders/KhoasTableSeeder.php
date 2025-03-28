<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Khoa;

class KhoasTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        Khoa::insert([
                ['makhoa' => 'YHOC', 'tenkhoa' => 'Khoa Y'],
                ['makhoa' => 'RHM', 'tenkhoa' => 'Khoa Răng Hàm Mặt'],
                ['makhoa' => 'DD', 'tenkhoa' => 'Khoa Điều dưỡng'],
                ['makhoa' => 'VLTL', 'tenkhoa' => 'Khoa Vật lý trị liệu và Phục hồi chức năng'],
                ['makhoa' => 'KTXN', 'tenkhoa' => 'Khoa Kỹ thuật Xét nghiệm Y học'],
                ['makhoa' => 'DUOC', 'tenkhoa' => 'Khoa Dược'],
                ['makhoa' => 'HS', 'tenkhoa' => 'Khoa Hộ sinh'],
                ['makhoa' => 'KTQT', 'tenkhoa' => 'Khoa Kinh tế và Quản trị'],
                ['makhoa' => 'KTCN', 'tenkhoa' => 'Khoa Kỹ thuật và Công nghệ'],
                ['makhoa' => 'KHXH', 'tenkhoa' => 'Khoa Khoa học Xã hội và Nhân văn'],
            ]);
    }
}


