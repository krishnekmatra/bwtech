<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_id = User::assignRole('admin');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mailinator.com',
            'password' => bcrypt(123456),
            'phone' => '+9189123456781',
            'role_id' => $role_id
        ]);

    }
}
?>