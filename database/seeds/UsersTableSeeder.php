<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'nees@nees.nl',
            'admin' => 1,
            'gender' => 1,
            'type' => 1,
            'avatar' => 'public/defaults/avatars/default.svg',
            'slug' => str_slug('admin')
        ]);
    }
}
