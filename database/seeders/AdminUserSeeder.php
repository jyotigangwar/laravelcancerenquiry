<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([

            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin@123'),
            'cancer_id' => 0
        ]);
        
        $user = User::create([

            'name' => 'First Doctor',
            'email' => 'doctor@test.com',
            'password' => bcrypt('doctor@123'),
            'cancer_id' => 1
        ]);
        

    }
}
