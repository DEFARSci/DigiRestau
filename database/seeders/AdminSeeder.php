<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'nameEnseigne' => null,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('passer123'),
            'is_admin' => 1,
            'statut' => 'admin',
            'is_actived' => 0,
            'approved' => 0,
        ]);
    }
}
