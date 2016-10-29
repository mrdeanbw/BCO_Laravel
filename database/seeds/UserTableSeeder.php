<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@qwyk.io',
                'password' => bcrypt('secret'),
                'is_admin' => true,
                'created_at' => NULL,
                'updated_at' => NULL,
            )
        ));
    }
}
