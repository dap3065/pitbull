<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where(['email' => env('APP_EMAIL')])->first();
        if (!$user) {
            $user = User::create(
                [
                    'name' => 'Sleepy',
                    'email' => env('APP_EMAIL'),
                    'phone' => env('APP_PHONE'),
                    'password' => Hash::make(env('APP_PASSWORD')),
                    'allow_notifications' => true,
                ]
            );
            $user->assignRole('Admin');
        }
    }
}
