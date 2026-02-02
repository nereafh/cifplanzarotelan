<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SociosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('socios')->insert([
            [
                'nombre'    => 'Juan Pérez López',
                'dni'       => '12345678A',
                'edad'      => 34,
                'categoria' => 'OR',
                'iban'      => 'ES2100001111222233334444',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'María García Martínez',
                'dni'       => '87654321B',
                'edad'      => 28,
                'categoria' => 'PL',
                'iban'      => 'ES2199998888777766665555',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Carlos Rodríguez Sol',
                'dni'       => '11223344C',
                'edad'      => 45,
                'categoria' => 'BR',
                'iban'      => 'ES2155554444333322221111',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Ana Belén Ruiz',
                'dni'       => '55667788D',
                'edad'      => 52,
                'categoria' => 'OR',
                'iban'      => 'ES2112341234123412341234',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Lucas Modric Perea',
                'dni'       => '99887766E',
                'edad'      => 19,
                'categoria' => 'PL',
                'iban'      => 'ES2143214321432143214321',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Elena Santonja Cruz',
                'dni'       => '44556611F',
                'edad'      => 29,
                'categoria' => 'BR',
                'iban'      => 'ES2188887777666655554444',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Roberto Gómez Bolaños',
                'dni'       => '22334455G',
                'edad'      => 61,
                'categoria' => 'OR',
                'iban'      => 'ES2111112222333344445555',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Lucía Ferrán Torres',
                'dni'       => '99001122H',
                'edad'      => 22,
                'categoria' => 'PL',
                'iban'      => 'ES2122223333444455556666',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Marcos Alonso Peña',
                'dni'       => '33445566I',
                'edad'      => 38,
                'categoria' => 'BR',
                'iban'      => 'ES2133334444555566667777',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Sonia Monroy Plaza',
                'dni'       => '77889900J',
                'edad'      => 41,
                'categoria' => 'OR',
                'iban'      => 'ES2144445555666677778888',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Javier Sierra Marín',
                'dni'       => '55443322K',
                'edad'      => 55,
                'categoria' => 'PL',
                'iban'      => 'ES2155556666777788889999',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Patricia Conde Galán',
                'dni'       => '11009988L',
                'edad'      => 31,
                'categoria' => 'BR',
                'iban'      => 'ES2166667777888899990000',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Fernando Esteso Gil',
                'dni'       => '66778899M',
                'edad'      => 72,
                'categoria' => 'OR',
                'iban'      => 'ES2177778888999900001111',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Beatriz Luengo Rojo',
                'dni'       => '12123434N',
                'edad'      => 25,
                'categoria' => 'PL',
                'iban'      => 'ES2188889999000011112222',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nombre'    => 'Hugo Silva Sánchez',
                'dni'       => '56567878O',
                'edad'      => 44,
                'categoria' => 'BR',
                'iban'      => 'ES2199990000111122223333',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
        ]);
    }
}