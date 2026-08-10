<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'username' => 'atlas1',
                'email' => 'atlas1@example.com',
                'password' => Hash::make('atlas1'),
                'bio' => 'atlas1の自己紹介です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'atlas2',
                'email' => 'atlas2@example.com',
                'password' => Hash::make('atlas2'),
                'bio' => 'atlas2の自己紹介です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'atlas3',
                'email' => 'atlas3@example.com',
                'password' => Hash::make('atlas3'),
                'bio' => 'atlas3の自己紹介です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'atlas4',
                'email' => 'atlas4@example.com',
                'password' => Hash::make('atlas4'),
                'bio' => 'atlas4の自己紹介です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'atlas5',
                'email' => 'atlas5@example.com',
                'password' => Hash::make('atlas5'),
                'bio' => 'atlas5の自己紹介です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'atlas6',
                'email' => 'atlas6@example.com',
                'password' => Hash::make('atlas6'),
                'bio' => 'atlas6の自己紹介です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'atlas7',
                'email' => 'atlas7@example.com',
                'password' => Hash::make('atlas7'),
                'bio' => 'atlas7の自己紹介です。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
