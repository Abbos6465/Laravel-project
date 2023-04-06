<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $user=User::create([
            'name'=> "John",
            'email'=>'john@gmail.com',
            'password'=>Hash::make('JohnDoe123'),
            'photo'=>null,
            "role_id"=>1,
         ]);

        
        

         $user2=User::create([
            'name'=> "Abdulloh",
            'email'=>'abdulloh@gmail.com',
            'password'=>Hash::make('abdulloh123'),
            'photo'=>null,
            'role_id'=>2,
         ]);

    }
}
