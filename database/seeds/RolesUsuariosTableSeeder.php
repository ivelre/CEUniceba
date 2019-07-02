<?php

use Illuminate\Database\Seeder;

class RolesUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("roles_usuarios")->insert([ "id" => 1, "rol_usuario" => "Administrador" ]);
        DB::table("roles_usuarios")->insert([ "id" => 2, "rol_usuario" => "Estudiante" ]);
        DB::table("roles_usuarios")->insert([ "id" => 3, "rol_usuario" => "Maestro" ]);
    }
}
