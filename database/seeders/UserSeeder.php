<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create(
        [
            'first_name' => 'Admin',
            'last_name' => 'admin',
            'email'=>'admin@mail.com',
            'role_id'=> 2,
            'password' => bcrypt('admin1234')
        ]);
        
        User::create([
            'first_name' => 'Pemilik',
            'last_name' => 'Toko',
            'email'=>'pemilik@mail.com',
            'role_id'=> 1,
            'password' => bcrypt('pemilik1234')
        ]);
    }
}