<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diem;

class DiemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diem::insert([
            [
                'madiem' => 'A001',
                'diemcc' => 10,
                'diemtx' => 10,
                'diemgk' => 10,
                'diemck' => 10,
                'diemtong' => 10, // Thêm tổng điểm nếu cần
                'diemrl' => 100, // Thêm điểm rèn luyện nếu có
                'HeSodiemcc' => 10,
                'HeSodiemtx' => 10,
                'HeSodiemgk' => 10,
                'HeSodiemck' => 10,
                'monhoc_id'=>1,
                'sinhvien_id' => 1,

            ],
        ]);
    }
}
