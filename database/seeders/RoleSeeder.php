<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['name'=>'admin'],
            ['name'=>'vendor'],
            ['name'=>'customer'],
        ];
        \App\Models\Role::insert($data);     

    }
}
?>