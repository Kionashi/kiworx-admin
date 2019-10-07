<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        // Create Víctor User
        $user = new User;
        $user->name = 'Víctor';
        $user->email = 'vcardozof@gmail.com';
        $user->password = bcrypt('123456');
        $user->save();
        
        $accessToken = $user->createToken('authToken')->accessToken;
        
        // Create generic admin user
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('123456');
        $user->save();
        
        $accessToken = $user->createToken('authToken')->accessToken;
        
//         for($i=0; $i<10; $i++) {
//             User::create([
//                 'name' => Str::random(10),
//                 'lastname' => Str::random(10),
//                 'email' => Str::random(10).'@gmail.com',
//                 'password' => Hash::make('123456'),
//                 'api_token' => Str::random(60)
//             ]);            
//         }
    }
}
