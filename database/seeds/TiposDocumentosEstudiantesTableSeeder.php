<?php

use Illuminate\Database\Seeder;

class TiposDocumentosEstudiantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tipos_documentos_estudiantes")->insert([ "id" => 1, "tipo_documento" => "Acta de nacimiento" ]);
        DB::table("tipos_documentos_estudiantes")->insert([ "id" => 2, "tipo_documento" => "Certificado de bachillerato" ]);
        DB::table("tipos_documentos_estudiantes")->insert([ "id" => 3, "tipo_documento" => "Fotografía tamaño infantil" ]);
        DB::table("tipos_documentos_estudiantes")->insert([ "id" => 4, "tipo_documento" => "Copia CURP" ]);
        DB::table("tipos_documentos_estudiantes")->insert([ "id" => 5, "tipo_documento" => "Dictamen de equivalencia" ]);
    }
}
