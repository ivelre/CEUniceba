<?php

use Illuminate\Database\Seeder;

class DatosGeneralesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\DatoGeneral::class,150)->create();
    }
}
