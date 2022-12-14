<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'username' => 'dokgorewind'
        ], [
            'username' => 'dokgorewind',
            'password' => Hash::make('ridho123'),
            'name' => 'Dokgo Rewind',
            'is_active' => 1,
            'id_tipe_user' => 1,
        ]);

        User::updateOrCreate([
            'username' => 'hidayat'
        ], [
            'username' => 'hidayat',
            'password' => Hash::make('dayat123'),
            'name' => 'Muhammad Hidayatullah',
            'is_active' => 1,
            'id_tipe_user' => 1,
        ]);

        User::updateOrCreate([
            'username' => 'admin'
        ], [
            'username' => 'admin',
            'password' => Hash::make('adminadmin'),
            'name' => 'Admin',
            'is_active' => 1,
            'id_tipe_user' => 1,
        ]);
    }
}
