<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if(User::where('role_id')->count() == 0){
            User::create([
                "name" => "Jason",
                "username" => "ci220101",
                "email" => "ci220101@student.uthm.edu.my",
                "password" => bcrypt("123456"),
                "mobileNumber" => "0192736581",
                "role_id" => 1,
            ]);
        }
    }
}
