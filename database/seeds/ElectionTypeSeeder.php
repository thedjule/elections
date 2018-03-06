<?php

use Illuminate\Database\Seeder;

class ElectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Add Election Types */

        DB::table('election_types')->insert([
            ['name' => 'Parlamentarni'],
            ['name' => 'Predsjednički'],
            ['name' => 'Lokalni']
        ]);
    }
}
