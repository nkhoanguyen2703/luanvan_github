<?php

use Illuminate\Database\Seeder;

class GVseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('GiangVien')->insert([
            'gv_ma' => 'GV5',
            'password' => bcrypt('123456'),
            'gv_ten' => 'Thu An 2',
            'bm_ma' => 'BM_KHMT',
            
        ]);
    }
}
