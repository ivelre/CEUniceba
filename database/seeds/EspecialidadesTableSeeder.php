<?php

use Illuminate\Database\Seeder;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("especialidades")->insert([
        	"id"                          => 1, 
        	"nivel_academico_id"          => 1, 
        	"clave"                       => "992374", 
        	"especialidad"                => "Administración", 
        	"reconocimiento_oficial"      => "RVOE-992374",
        	"dges"                        => "992374-RVOE",
        	"fecha_reconocimiento"        => "2016-6-7",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 2, 
        	"nivel_academico_id"          => 1, 
        	"clave"                       => "20140054", 
        	"especialidad"                => "Contaduría Pública", 
        	"reconocimiento_oficial"      => "RVOE-20140054",
        	"dges"                        => "20140054-RVOE",
        	"fecha_reconocimiento"        => "2014-3-24",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 3, 
        	"nivel_academico_id"          => 1, 
        	"clave"                       => "972398", 
        	"especialidad"                => "Derecho", 
        	"reconocimiento_oficial"      => "RVOE-972398",
        	"dges"                        => "972398-RVOE",
        	"fecha_reconocimiento"        => "1997-10-28",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 4, 
        	"nivel_academico_id"          => 1, 
        	"clave"                       => "20140055", 
        	"especialidad"                => "Negocios Internacionales", 
        	"reconocimiento_oficial"      => "RVOE-20140055",
        	"dges"                        => "20140055-RVOE",
        	"fecha_reconocimiento"        => "2014-3-24",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 5, 
        	"nivel_academico_id"          => 1, 
        	"clave"                       => "20170118", 
        	"especialidad"                => "Ingeniería Industrial", 
        	"reconocimiento_oficial"      => "RVOE-20170118",
        	"dges"                        => "20170118-RVOE",
        	"fecha_reconocimiento"        => "2016-3-18",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 6, 
        	"nivel_academico_id"          => 1, 
        	"clave"                       => "2002106", 
        	"especialidad"                => "Pedagogía", 
        	"reconocimiento_oficial"      => "RVOE-2002106",
        	"dges"                        => "2002106-RVOE",
        	"fecha_reconocimiento"        => "2000-5-26",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 7, 
        	"nivel_academico_id"          => 1, 
        	"clave"                       => "20130060", 
        	"especialidad"                => "Psicología Educativa", 
        	"reconocimiento_oficial"      => "RVOE-20130060",
        	"dges"                        => "20130060-RVOE",
        	"fecha_reconocimiento"        => "2017-2-17",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 8, 
        	"nivel_academico_id"          => 1, 
        	"clave"                       => "2002043", 
        	"especialidad"                => "Sistemas Computacionales", 
        	"reconocimiento_oficial"      => "RVOE-2002043",
        	"dges"                        => "2002043-RVOE",
        	"fecha_reconocimiento"        => "2017-3-10",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 9, 
        	"nivel_academico_id"          => 2, 
        	"clave"                       => "2004100", 
        	"especialidad"                => "Administración", 
        	"reconocimiento_oficial"      => "RVOE-2004100",
        	"dges"                        => "2004100-RVOE",
        	"fecha_reconocimiento"        => "2000-5-19",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 10, 
        	"nivel_academico_id"          => 2,
        	"clave"                       => "20110324", 
        	"especialidad"                => "Sistema Penal Acusatorio y Oral", 
        	"reconocimiento_oficial"      => "RVOE-20110324",
        	"dges"                        => "20110324-RVOE",
        	"fecha_reconocimiento"        => "2011-5-26",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 11, 
        	"nivel_academico_id"          => 2,
        	"clave"                       => "2006389", 
        	"especialidad"                => "Derecho Constitucional y Amparo", 
        	"reconocimiento_oficial"      => "RVOE-2006389",
        	"dges"                        => "2006389-RVOE",
        	"fecha_reconocimiento"        => "2006-10-20",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 12, 
        	"nivel_academico_id"          => 2,
        	"clave"                       => "20090067", 
        	"especialidad"                => "Derecho Laboral", 
        	"reconocimiento_oficial"      => "RVOE-20090067",
        	"dges"                        => "20090067-RVOE",
        	"fecha_reconocimiento"        => "2009-4-22",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 13, 
        	"nivel_academico_id"          => 2,
        	"clave"                       => "2005099", 
        	"especialidad"                => "Docencia", 
        	"reconocimiento_oficial"      => "RVOE-2005099",
        	"dges"                        => "2005099-RVOE",
        	"fecha_reconocimiento"        => "2005-2-28",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 14, 
        	"nivel_academico_id"          => 2,
        	"clave"                       => "2004101", 
        	"especialidad"                => "Fiscal", 
        	"reconocimiento_oficial"      => "RVOE-2004101",
        	"dges"                        => "2004101-RVOE",
        	"fecha_reconocimiento"        => "2000-4-19",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 15, 
        	"nivel_academico_id"          => 2,
        	"clave"                       => "20110325", 
        	"especialidad"                => "Logística Internacional", 
        	"reconocimiento_oficial"      => "RVOE-20110325",
        	"dges"                        => "20110325-RVOE",
        	"fecha_reconocimiento"        => "2011-4-26",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 16, 
        	"nivel_academico_id"          => 3,
        	"clave"                       => "20120084", 
        	"especialidad"                => "Administración y Gestión Empresarial", 
        	"reconocimiento_oficial"      => "RVOE-20120084",
        	"dges"                        => "20120084-RVOE",
        	"fecha_reconocimiento"        => "2012-1-16",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 17, 
        	"nivel_academico_id"          => 3,
        	"clave"                       => "20122985", 
        	"especialidad"                => "Derecho", 
        	"reconocimiento_oficial"      => "RVOE-20122985",
        	"dges"                        => "20122985-RVOE",
        	"fecha_reconocimiento"        => "2012-11-30",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

        DB::table("especialidades")->insert([
        	"id"                          => 18, 
        	"nivel_academico_id"          => 3,
        	"clave"                       => "20160266", 
        	"especialidad"                => "Educación", 
        	"reconocimiento_oficial"      => "RVOE-20160266",
        	"dges"                        => "20160266-RVOE",
        	"fecha_reconocimiento"        => "2014-4-30",
        	"modalidad_id"                => 1,
            "tipo_plan_especialidad_id"   => rand(1,3)
        ]);

    }
}
