<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SeedDefaultAdminAccount extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = new User();
        $user->fistname = "admin";
        $user->lastname = "root";
        $user->username = "admin";
        $user->password = Hash::make("admin@root23");
        $user->email = env('MAIL_FROM_ADDRESS', "admin@root.com");

    }
}
