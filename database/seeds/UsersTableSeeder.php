<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Gera usuário padrão
         */
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'Usuário',
            'email' => 'usuario@email.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
