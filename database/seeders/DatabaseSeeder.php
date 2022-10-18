<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AccessKey;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create()

        AccessKey::create([
            'name' => 'default',
            'key' => Hash::make('tdy9l6lityyxh5v')
        ]);

         User::factory()->create([
             'name' => 'Dennis',
             'password' => Hash::make('pellio2014'),
         ]);
    }
}
