<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('123456')
            ]
        );
        factory(\App\User::class,50)->create();
    }
}
