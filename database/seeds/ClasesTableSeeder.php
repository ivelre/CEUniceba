<?php

use Illuminate\Database\Seeder;
use App\Models\Docente;
use App\Models\Periodo;
use App\Models\Clase;
use App\Models\Especialidad;

class ClasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clase = array("A","B","C","D");
        $no_docentes = count(Docente::get());
        $periodos = Periodo::get();

        $especialidades = Especialidad::get();

        foreach ($especialidades as $key_1 => $especialidad) {
            
            $asignaturas_especialidad = [];

            $planes_especialidades = $especialidad->planes_especialidades;

            foreach ($planes_especialidades as $key_2 => $plan_especialidad) {
                
                $asignaturas_plan = $plan_especialidad->asignaturas;


                foreach ($asignaturas_plan as $key_3 => $asignatura_plan) {
                    
                    $match = false;
                    foreach ($asignaturas_especialidad as $key_4 => $asignatura_especialidad) {
                        
                        if($asignatura_especialidad->id == $asignatura_plan->id){

                            $match=true;

                        }

                    }

                    if(!$match){

                        array_push($asignaturas_especialidad,$asignatura_plan);

                    }

                }

            }

            foreach ($asignaturas_especialidad as $key_2 => $asignatura_especialidad) {
                
                foreach ($periodos as $key_3 => $periodo) {
                    
                    $no_clases = rand(1,4);
                    for ($i=0; $i < $no_clases; $i++) { 
                        Clase::create([
                            'asignatura_id'     => $asignatura_especialidad->id,
                            'clase'             => $clase[$i],
                            'docente_id'        => rand(1,$no_docentes),
                            'periodo_id'        => $periodo->id,
                            'especialidad_id'   => $especialidad->id
                        ]);
                    }

                }

            }    

        }
    	
        
    }
}

