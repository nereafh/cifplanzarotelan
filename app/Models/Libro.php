<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //
    static $cods_genero = [
         '' => ''
        ,'FS' => 'Ficción Siencia'
        ,'RM' => 'Romance'
        ,'CF' => 'Ciencia Ficción'
        ,'NC' => 'Novela Clásica'
        ,'FA' => 'Fantasía'
        ,'NV' => 'Novela'
        ,'SP' => 'Suspense'
    ];
}