<?php

use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
        \DB::table('materials')->insert([
          ['value' => 'Madera 2'],
          ['value' => 'Madera 3'],
          ['value' => 'Madera 4'],
          ['value' => 'Madera 5'],
          ['value' => 'Madera 6']
        ]);
        */

        \DB::insert("INSERT INTO materials (value) VALUES('Madera 7')");
    }
}
