<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private $number_of_regular_users = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory($this->number_of_regular_users)->create();
        User::factory([
            "email" => "admin@szerveroldali.hu",
            "password" => password_hash("adminpwd", PASSWORD_DEFAULT),
            "is_admin" => true,
        ])->create();
    }
}
