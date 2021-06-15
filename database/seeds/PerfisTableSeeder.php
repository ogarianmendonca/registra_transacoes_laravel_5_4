<?php

use App\Entities\Perfil;
use Illuminate\Database\Seeder;

class PerfisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create([
            'no_perfil' => 'ADMINISTRADOR',
            'st_ativo' => true,
        ]);

        Perfil::create([
            'no_perfil' => 'USUARIO',
            'st_ativo' => true,
        ]);
    }
}
