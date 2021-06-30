<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendents')->insert([
            'cpf' => '98323485794',
            'name' => 'Maria lima',
            'password' => bcrypt('123456')
        ]);
    }
}
