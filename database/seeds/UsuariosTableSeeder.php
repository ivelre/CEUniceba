<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\PlanEspecialidad;
class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'email'    => 'jaqueline.sanchez@uniceba.edu.mx',
            'password' => bcrypt('1234567'),
            'rol_id'   => 1
        ]);
        Usuario::create([
            'email'    => 'rector',
            'password' => bcrypt('1234567'),
            'rol_id'   => 1
        ]);
    }
}
