<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'fauzan',
            'email' => 'fauzan@gmail.com',
            'role_id' => 1
        ]);
        User::factory()->count(5)->create();
    }
}
