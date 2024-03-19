<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(LaratrustSeeder::class);

        // $user = User::create([
        //     'name' => 'administrator',
        //     'email' => 'admin@gmail.com',
        //     'password' => '12345678',
        //     'role' => 'Administrator',
        // ]);

        // $user->attachRole('Administrator');

        $user2 = User::create([
            'name' => 'operator',
            'email' => 'operator@gmail.com',
            'password' => 'rahasia',
            'role' => 'operator',
        ]);

        $user2->attachRole('operator');

        $user3 = User::create([
            'name' => 'ValidatorOpsis',
            'email' => 'vadopse@gmail.com',
            'password' => 'password',
            'role' => 'ValidatorOpsis
            ',
        ]);
        $user3->attachRole('ValidatorOpsis');

        $user4 = User::create([
            'name' => 'ValidatorFasop',
            'email' => 'vadfasop@gmail.com',
            'password' => 'secret',
            'role' => 'ValidatorFasop',
        ]);
        $user4->attachRole('ValidatorFasop');

        $user5 = User::create([
            'name' => 'EditorOpsis',
            'email' => 'editopsis@gmail.com',
            'password' => 'secret',
            'role' => 'EditorOpsis',
        ]);
        $user5->attachRole('EditorOpsis');

        $user6 = User::create([
            'name' => 'Visitor1',
            'email' => 'visitor@gmail.com',
            'password' => '12345678',
            'role' => 'Visitor',
        ]);
        $user6->attachRole('Visitor');




    }
}
