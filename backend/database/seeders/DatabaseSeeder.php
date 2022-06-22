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
            'password' => bcrypt('123456'),
            'username' => 'admin',
            'isAdmin' => true,
            'isDarkTheme' => false,
            'avatar' => 1
        ]);

        // test users
        DB::table('users')->insert([
            [
                'name' => 'Ednaldo Pereira',
                'email' => 'ednaldo@ednaldo.com',
                'password' => bcrypt('123456'),
                'username' => 'ednaldopereira',
                'isAdmin' => false,
                'isDarkTheme' => false,
                'hits' => 7,
                'monthHits' => 7,
                'maxRank' => 7,
                'hp' => 2,
                'xp' => 25,
                'avatar' => 2
            ],
            [
                'name' => 'Rafael Diehl',
                'email' => 'rafaeljuliani1984@gmail.com',
                'password' => bcrypt('123456'),
                'username' => 'rafaeldiehl',
                'isAdmin' => false,
                'isDarkTheme' => true,
                'hits' => 10,
                'monthHits' => 5,
                'maxRank' => 1,
                'hp' => 3,
                'xp' => 40,
                'avatar' => 3
            ]
        ]);
    }
}

