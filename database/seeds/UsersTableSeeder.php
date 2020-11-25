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
        $user = \App\User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('asd123')
        ]);

        $user->attachRole('super_admin');
		// Admin.
		$user = \App\User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('asd123')
        ]);

        $user->attachRole('admin');
    } // end of run


}// end of seeder
