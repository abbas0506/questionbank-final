<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Individual;
use App\Models\Institution;
use App\Models\Teacher;
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
        //
        // $admin=Admin::create(['name'=>'Muhammad Abbas']);
        $user = User::create([
            'name' => 'Muhammad Abbas',
            'email' => 'abbas.sscs@gmail.com',
            'password' => Hash::make('password'),

        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Azeem Rehan',
            'email' => 'mianazeemdaula@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Data Expert',
            'email' => 'data@exampixel.com',
            'password' => Hash::make('password'),

        ]);

        $user->assignRole('operator');

        $user = User::create([
            'name' => 'GHSS Chak Bedi, Pakpattan',
            'email' => 'principal.ghsschakbedi@gmail.com',
            'password' => Hash::make('password'),

        ]);

        $user->institution()->create([
            'logo' => '',
            'phone' => '03000373004',
            'address' => 'Village Chak bedi, Pakpattan',
        ]);
        $user->assignRole(['institution']);


        $user = User::create([
            'name' => 'Muzammil Hussain',
            'email' => 'muzammilhussain@gmail.com',
            'password' => Hash::make('password'),

        ]);
        $user->teacher()->create([
            'subject_id' => 4,
            'phone' => '03167717963',
        ]);

        $user->assignRole(['collaborator', 'teacher']);
    }
}
