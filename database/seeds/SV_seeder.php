<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SV_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('SinhVien')->insert([
            'sv_ma' => 'SV8',
            'password' => bcrypt('123456'),
            'sv_ten' => 'Khanh',
            'sv_khoahoc' => '40',
            'manganh' => 'DI_KH',
        ]);
    }
}
