<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Room::create(['name' => 'Melati 1', 'pax' => 2]);
        \App\Room::create(['name' => 'Melati 2', 'pax' => 2]);
        \App\Room::create(['name' => 'Melati 3', 'pax' => 2]);
        \App\Room::create(['name' => 'Melati 4', 'pax' => 2]);
        \App\Room::create(['name' => 'Melati 5', 'pax' => 2]);
        \App\Room::create(['name' => 'Mawar 1', 'pax' => 4]);
        \App\Room::create(['name' => 'Mawar 2', 'pax' => 4]);
        \App\Room::create(['name' => 'Mawar 3', 'pax' => 4]);
        \App\Room::create(['name' => 'Mawar 4', 'pax' => 4]);
        \App\Room::create(['name' => 'Mawar 5', 'pax' => 4]);
        \App\Room::create(['name' => 'Cempaka 1', 'pax' => 12]);
        \App\Room::create(['name' => 'Cempaka 2', 'pax' => 12]);
        \App\Room::create(['name' => 'Cempaka 3', 'pax' => 12]);
        \App\Room::create(['name' => 'Cempaka 4', 'pax' => 12]);
        \App\Room::create(['name' => 'Cempaka 5', 'pax' => 12]);
        \App\Room::create(['name' => 'Sari 1', 'pax' => 20]);
        \App\Room::create(['name' => 'Sari 2', 'pax' => 20]);
        \App\Room::create(['name' => 'Sari 3', 'pax' => 20]);
        \App\Room::create(['name' => 'Sari 4', 'pax' => 20]);
        \App\Room::create(['name' => 'Sari 5', 'pax' => 20]);
    }
}