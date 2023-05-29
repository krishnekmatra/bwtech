<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class salesSeeder extends Seeder
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
          
            ['name' => 'Sales Team'],
            ['name' => 'Management']
        ];
        \App\Models\Role::insert($data);     
    }
}
