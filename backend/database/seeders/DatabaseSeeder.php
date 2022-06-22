<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // initial avatars
        DB::table('avatars')->insert([
            [
                'name' => 'Roxo',
                'imageUrl' => 'https://i.imgur.com/647bBDh.png',
                'isAvailable' => true,
            ],
            [
                'name' => 'Verde',
                'imageUrl' => 'https://i.imgur.com/sRdAV6W.png',
                'isAvailable' => true,
            ],
            [
                'name' => 'Amarelo',
                'imageUrl' => 'https://i.imgur.com/8pvfkWI.png',
                'isAvailable' => true,
            ],
            [
                'name' => 'Rosa',
                'imageUrl' => 'https://i.imgur.com/Apkzere.png',
                'isAvailable' => true,
            ]
        ]);

        // initial question types
        DB::table('types')->insert([
            [
                'name' => 'Dissertativa',
                'alternativesNumber' => 0,
            ],
            [
                'name' => 'Alternativa',
                'alternativesNumber' => 4,
            ],
            [
                'name' => 'Selecione',
                'alternativesNumber' => 4,
            ],
            [
                'name' => 'Verdadeiro ou falso',
                'alternativesNumber' => 2,
            ],
        ]);

        // default admin
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => '123456',
            'username' => 'admin',
            'isAdmin' => true,
            'isDarkTheme' => false,
            'avatar' => 1
        ]);
    }
}

