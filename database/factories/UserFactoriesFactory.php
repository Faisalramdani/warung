<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserFactoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'first_name' => 'Pemilik',
            'last_name' => 'Toko',
            'email'=>'pemilik@mail.com',
            'role_id'=> 1,
            'password' => bcrypt('pemilik1234')
        ];
    }
}
