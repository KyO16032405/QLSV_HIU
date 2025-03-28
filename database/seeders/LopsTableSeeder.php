<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Lop;

class LopsTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            Lop::create([
                'malop' => strtoupper($faker->bothify('HB##')),  // VD: HB01, HB23
                'tenlopvt' => 'ĐHHB' . $faker->bothify('##'),  // VD: ĐHHB01
                'tenlop' => 'Đại học Hồng Bàng ',  // VD: Đại học Hồng Bàng 01
                'khoa_id' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}

