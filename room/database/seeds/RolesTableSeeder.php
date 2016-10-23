<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create(['name'=>'admin', 'description'=>'This is admin role']);
        \App\Role::create(['name'=>'member', 'description'=>'This is normal member role']);
    }
}
