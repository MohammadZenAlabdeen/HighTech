<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user= [
            "name"=>"admin",
            'email'=>'admin@admin.com',
            "password"=>"123123123",
            "is_admin"=>true,
        ];
        User::create($user);
    }
}
