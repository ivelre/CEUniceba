<?php

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class PlanesEspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades = Especialidad::get();

        foreach ($especialidades as $key => $especialidad) {
        	factory(App\Models\PlanEspecialidad::class,rand(1,3))->create([
        		'especialidad_id' => $especialidad->id
        	]);
        }
    }
}
