<?php
//Datos de prueba: php artisan make:seeder NombreTablaSeeder
//Ejecutar datos de prueba: php artisan db:seed --class=NombreTablaSeeder
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB; //Lo añado

class LibrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('libros')->insert([[
            'titulo'    => 'Harry Potter y la piedra filosofal',
            'autor'     => 'JK Rowling',
            'anho'       => '2001',
            'genero'     => 'FA',
            'descripcion' => 'La piedra filosofal'
        ],
        [
            'titulo'    => 'El señor de los anillos',
            'autor'     => 'J.R.R. Tolkien',
            'anho'       => '1954',
            'genero'     => 'FA',
            'descripcion' => 'La comunidad del anillo'
        ],
        [
            'titulo'    => 'Cien años de soledad',
            'autor'     => 'Gabriel García Márquez',
            'anho'       => '1967',
            'genero'     => 'RM',
            'descripcion' => 'Una saga familiar en Macondo'
        ],
        [
            'titulo'    => '1984',
            'autor'     => 'George Orwell',
            'anho'       => '1949',
            'genero'     => 'CF',
            'descripcion' => 'Una distopía totalitaria'
        ],
        [
            'titulo'    => 'Don Quijote de la Mancha',
            'autor'     => 'Miguel de Cervantes',
            'anho'       => '1605',
            'genero'     => 'NC',
            'descripcion' => 'Las AVs de un caballero loco'
        ],
        [
            'titulo'    => 'Matar a un ruiseñor',
            'autor'     => 'Harper Lee',
            'anho'       => '1960',
            'genero'     => 'FS',
            'descripcion' => 'Un juicio en el sur de Estados Unidos'
        ]
        ]);
    }
}
