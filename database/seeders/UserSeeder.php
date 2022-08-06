<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Samuel Adeoye',
            'email' => 'sam@example.com',
            'password' => Hash::make('123456'),
        ];
        User::create($user);
    }
}
