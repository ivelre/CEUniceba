<?php

use Illuminate\Database\Seeder;

class InstitutosProcedenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("institutos_procedencias")->insert([ "id" => 1, "institucion" => "Universidad Latina De México", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 2, "institucion" => "Escuela Preparatoria Colegio México", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 3, "institucion" => "Instituto Armando Olivares Carrillo", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 4, "institucion" => "Ateneo Celayense, A. C.", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 5, "institucion" => "Educación Nuevo Milenio", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 6, "institucion" => "Westminster Royal College", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 7, "institucion" => "Colegio Arturo Rosenblueth", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 8, "institucion" => "Itesm Campus Querétaro Sede Celaya", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 9, "institucion" => "Instituto Renee Descartes", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 10, "institucion" => "Instituto De Estudios Bajío", "municipio_id" => 11]);
        
        DB::table("institutos_procedencias")->insert([ "id" => 11, "institucion" => "Complejo Educativo Ignacio Allende", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 12, "institucion" => "Lasallista Benavente", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 13, "institucion" => "Universidad De Leon", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 14, "institucion" => "Instituto Magno", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 15, "institucion" => "Escuela Preparatoria Del Centro Medico Quirurgico De Celaya", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 16, "institucion" => "Colegio Pablo Picasso", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 17, "institucion" => "Oxford Instituto Educativo", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 18, "institucion" => "José Vasconcelos Calderon", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 19, "institucion" => "Justo Sierra", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 20, "institucion" => "Instituto De Estudios Superiores Del Bajío", "municipio_id" => 11]);

        DB::table("institutos_procedencias")->insert([ "id" => 21, "institucion" => "Bachillerato Manuel Concha", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 22, "institucion" => "Preparatoria Don Vasco De Quiroga, A. C.", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 23, "institucion" => "Bachillerato Nuevo Continente, Campus Celaya", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 24, "institucion" => "Escuela Preparatoria De Celaya Universidad De Guanajuato", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 25, "institucion" => "Centro De Bachillerato Tecnológico Industrial Y De Servicios Num. 198", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 26, "institucion" => "Centro De Estudios Tecnológicos Industrial Y De Servicios Num. 115", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 27, "institucion" => "Instituto Johannes Kepler", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 28, "institucion" => "Conservatorio De Musica Y Artes De Celaya", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 29, "institucion" => "Universidad Tecnologica Del Centro De México", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 30, "institucion" => "Instituto Remington", "municipio_id" => 11]);
        
        DB::table("institutos_procedencias")->insert([ "id" => 31, "institucion" => "Instituto Superior De Contabilidad Y Administración Del Centro", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 32, "institucion" => "Plantel Conalep 028. Celaya", "municipio_id" => 11]);
        DB::table("institutos_procedencias")->insert([ "id" => 33, "institucion" => "Preparatoria Colegio Panamericano", "municipio_id" => 11]);
    }
}
