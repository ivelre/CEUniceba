<?php

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'empresa' => 'No trabaja'
        ]);
        
        factory(App\Models\Empresa::class,50)->create();
    }
}
