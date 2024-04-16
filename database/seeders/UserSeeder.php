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
            'userable_type' => 'App\Models\Admin',

        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Azeem Rehan',
            'email' => 'mianazeemdaula@gmail.com',
            'password' => Hash::make('password'),
            'userable_type' => 'App\Models\Admin',

        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Operator',
            'email' => 'data@exam.txdevs.com',
            'password' => Hash::make('password'),
            'userable_type' => 'App\Models\Operator',

        ]);

        $user->assignRole('operator');


        $institution = Institution::create([
            'logo' => '',
            'phone' => '03000373004',
            'address' => ' Chak bedi, Pakpattan',
        ]);
        $teacher = Teacher::create([
            'institution_id' => $institution->id,
            'subject_id' => 4,
            'phone' => '030034683246',
            'is_active' => true,
        ]);

        $user = User::create([
            'name' => 'Muzammil Hussain',
            'email' => 'muzammilhussain@gmail.com',
            'password' => Hash::make('password'),
            'userable_id' => $teacher->id,
            'userable_type' => 'App\Models\Teacher',

        ]);

        $user->assignRole(['collaborator', 'teacher']);
    }
}
