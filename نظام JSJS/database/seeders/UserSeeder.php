<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'musheer'],
            [
                'name' => 'مشير المقطري',
                'email' => 'musheer@jsjs.com',
                'password' => Hash::make('12345'),
            ]
        );

        User::updateOrCreate(
            ['username' => 'abood'],
            [
                'name' => 'عبود القاضي',
                'email' => 'abood@jsjs.com',
                'password' => Hash::make('12345'),
            ]
        );

        User::updateOrCreate(
            ['username' => 'bassam'],
            [
                'name' => 'بسام',
                'email' => 'bassam@jsjs.com',
                'password' => Hash::make('12345'),
            ]
        );
    }
}
