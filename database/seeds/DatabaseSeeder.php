<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Víctor User
        $user = new User;
        $user->name = 'Víctor';
        $user->email = 'vcardozof@gmail.com';
        $user->password = bcrypt('123456');
        $user->save();
        
        // Create generic admin user
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('123456');
        $user->save();
    }
}
