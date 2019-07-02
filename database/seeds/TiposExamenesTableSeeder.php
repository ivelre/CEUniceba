<?php

use Illuminate\Database\Seeder;

class TiposExamenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TipoExamen::class,5)->create();
    }
}
