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
            'name'      => 'Santiago',
            'email'     => 'santiagomurillo064@gmail.com',
            'password'  => bcrypt('12345678')
        ])->assignRole('Administrador');

        
    }
}
