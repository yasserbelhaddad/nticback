<?php

namespace Database\Seeders;

use App\Models\Prsnadministrative;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PrsnAdministrativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'prsnadministrative',
            'email' => 'prsnadministrative@gmail.com',
            'role' => 'Prsnadministrative',
            'password' => Hash::make('12345678')
        ]);

        Prsnadministrative::create([
            'firstname' => 'prsnadministrative',
            'lastname' => 'prsnadministrative',
            'email' => 'prsnadministrative@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
