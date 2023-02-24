<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "order_date"=>now(),
            "grand_total"=>0,
            "fist_name"=>$this->faker->firstName,
            "last_name"=>$this->faker->lastName,
            "country"=>$this->faker->country,
            "shipping_address"=>$this->faker->address,
            "post_code"=>$this->faker->postcode,
            "customer_tel"=>$this->faker->phoneNumber,
            "customer_email"=>$this->faker->unique()->email
        ];
    }
}
