<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name'=>'Luthfiyah S',
            'email'=>'piaaasan@gmail.com',
            'password'=>Hash::make('1'),
            'role'=>'Calon Mahasiswa'
        ]);

    }
}
