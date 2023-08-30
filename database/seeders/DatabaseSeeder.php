<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            ['user_name'=> 'user_1', 'email' => 'user_1@gmail.com'],
            ['user_name'=> 'user_2', 'email' => 'user_2@gmail.com'],
            ['user_name'=> 'user_3', 'email' => 'user_3@gmail.com'],
            ['user_name'=> 'user_4', 'email' => 'user_4@gmail.com'],
            ['user_name'=> 'user_5', 'email' => 'user_5@gmail.com'],
            ['user_name'=> 'user_6', 'email' => 'user_6@gmail.com'],
            ['user_name'=> 'user_7', 'email' => 'user_7@gmail.com'],
            ['user_name'=> 'user_8', 'email' => 'user_8@gmail.com'],
            ['user_name'=> 'user_9', 'email' => 'user_9@gmail.com'],
        ];
        $subscription = [
            ['user_id' => 1, "website_id" => 2],
            ['user_id' => 1, "website_id" => 5],
            ['user_id' => 2, "website_id" => 1],
            ['user_id' => 2, "website_id" => 4],
            ['user_id' => 2, "website_id" => 5],
            ['user_id' => 3, "website_id" => 1],
            ['user_id' => 3, "website_id" => 2],
            ['user_id' => 4, "website_id" => 3],
            ['user_id' => 4, "website_id" => 4],
            ['user_id' => 4, "website_id" => 5],
            ['user_id' => 5, "website_id" => 2],
            ['user_id' => 5, "website_id" => 4],
            ['user_id' => 6, "website_id" => 1],
            ['user_id' => 6, "website_id" => 3],
            ['user_id' => 6, "website_id" => 5],
            ['user_id' => 7, "website_id" => 2],
            ['user_id' => 7, "website_id" => 3],
            ['user_id' => 7, "website_id" => 4],
            ['user_id' => 8, "website_id" => 1],
            ['user_id' => 8, "website_id" => 3],
            ['user_id' => 9, "website_id" => 2],
            ['user_id' => 9, "website_id" => 4],
        ];
        $web_site = [
            ['website_name'=> 'website_1'],
            ['website_name'=> 'website_2'],
            ['website_name'=> 'website_3'],
            ['website_name'=> 'website_4'],
            ['website_name'=> 'website_5'],
        ];

        DB::table('users')->insert($users);
        DB::table('websites')->insert($web_site);
        DB::table('subscription')->insert($subscription);

    }
}
