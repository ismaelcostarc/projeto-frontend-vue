<?php

namespace Database\Factories;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cpf' => $this->faker->shuffle('12345678901'),
            'name' => $this->faker->name,
            'password' => bcrypt('123456'),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'birthday' => $this->faker->date('Y-m-d'),
            'zipcode' => $this->faker->postcode,
            'state' => $this->faker->stateAbbr,
            'city' => $this->faker->city,
            'attendent_id' => 1
        ];
    }
}
