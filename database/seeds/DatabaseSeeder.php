<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        $this->call(AdminTableSeeder::class);
        DB::table('admins')->insert([
            'id' => 2,
            'name' => 'Nguyen Sy Khai',
            'email' => 'admin1@gmail.com',
            'phone' => '0123456789',
            'password' => '$2y$10$.g6QYH.abH3Hr5Os9emXw.MKeE/3M4xKGfNWXDoA7iJF.AyMxDaNS',
        ]);
    }
}
