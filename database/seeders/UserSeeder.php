<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            [
                'name'=>'Maulana Bintang',
                'username'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('admin'),
                'role'=>'Administrator',
                'gambar'=>'images/team-img-02.JPG',
            ],
            [
                'name'=>'Gustania Nirmala',
                'username'=>'operator',
                'email'=>'operator@admin.com',
                'password'=>Hash::make('operator'),
                'role'=>'Operator',
                'gambar'=>'images/team-img-04.JPG',
            ],
        ]);
    }
}
