<?php

use Illuminate\Database\Seeder;
use App\Models\PlanEspecialidad;

class ReticulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $planes_especialidades = PlanEspecialidad::get();
      foreach ($planes_especialidades as $key => $plan_especialidad) {
        for ($i=0; $i < 25; $i++) { 
          factory(App\Models\Reticula::class,1)->create([
            'plan_especialidad_id'      => $plan_especialidad->id,
            'periodo_reticula' => rand(1,$plan_especialidad->periodos)
          ]);
        }
      }
    }
    
}
