<?php

use Illuminate\Database\Seeder;

class DefaultMunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Add Default Municipalities */

        DB::table('default_municipalities')->insert([
            ['name' => 'Andrijevica'],
            ['name' => 'Bar'],
            ['name' => 'Berane'],
            ['name' => 'Bijelo Polje'],
            ['name' => 'Cetinje'],
            ['name' => 'Budva'],
            ['name' => 'Danilovgrad'],
            ['name' => 'Gusinje'],
            ['name' => 'Herceg Novi'],
            ['name' => 'Kolašin'],
            ['name' => 'Kotor'],
            ['name' => 'Mojkovac'],
            ['name' => 'Nikšić'],
            ['name' => 'Petnjica'],
            ['name' => 'Plav'],
            ['name' => 'Plužine'],
            ['name' => 'Pljevlja'],
            ['name' => 'Podgorica'],
            ['name' => 'Rožaje'],
            ['name' => 'Šavnik'],
            ['name' => 'Tivat'],
            ['name' => 'Ulcinj'],
            ['name' => 'Žabljak'],
            ['name' => 'ZIKS']
        ]);
    }
}
