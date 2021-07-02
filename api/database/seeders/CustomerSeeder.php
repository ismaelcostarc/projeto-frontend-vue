<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'cpf' => '87318186094',
            'name' => 'João Luíz da Silva',
            'password' => bcrypt('123456'),
            'email' => 'joao@gmail.com',
            'phone' => '8699844556677',
            'birthday' => '1990-03-04',
            'zipcode' => '64000000',
            'state' => 'PI',
            'city' => 'Teresina',
            'attendent_id' => 1
        ]);

        \App\Models\Customers::factory()
            ->count(20)
            ->create();
    }
}
