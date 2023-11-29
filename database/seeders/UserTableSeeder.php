<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::where('role_id')->count() == 0){
            User::create([
                "name" => "User1",
                "username" => "ci220106",
                "email" => "ci220106@student.uthm.edu.my",
                "mobileNumber" => "01836392857",
                "password" => bcrypt("123456"),
            ]);
        }
    }
}
