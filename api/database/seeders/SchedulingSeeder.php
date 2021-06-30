<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedulings')->insert([
            'date' => '2021-08-04',
            'hour' => '08:00:00',
            'health_insurance' => 'IAPEP',
            'place' => 'Unimed',
            'exam' => 'Hemograma',
            'customer_id' => 1
        ]);
    }
}
