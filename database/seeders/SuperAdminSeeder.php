<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;



class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'SGNAN',
            'email'     => 'deliciasnan@gmail.com',
            'password'  => bcrypt('SG12345678')
        ])->assignRole('Administrador');

        
    }
}
