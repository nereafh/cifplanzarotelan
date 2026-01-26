<?php
//php artisan make:model NombreDelModelo

//Estrucutura de la tabla: php artisan make:migration create_nombre_de_la_tabla_table
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //Estos son las opciones que se van a poder elegir, el usuario no puede poner otras
    /*
        const GENEROS = [
         'FA' => 'Fantasía'
        ,'RM' => 'Realismo mágico'
        ,'CF' => 'Ciencia ficción'
        ,'NC' => 'Novela clásica'
        ,'FS' => 'Ficción social'
        ,'SP' => 'Suspenso'
        ,'RO' => 'Romántico'
        ,'TE' => 'Terror'
        ,'TR' => 'Tragedia'
        ,'FF' => 'Ficción filosófica'
        ,'HT' => 'Histórico'
        ,'RL' => 'Religión'
        ,'AV' => 'Aventura'
        ,'PS' => 'Psicológico'
        ,'FG' => 'Ficción gótica'
        ,'EP' => 'Épico'
        ,'PE' => 'Poesía épica'
        ,'MM' => 'Memorias'
        ,'PA' => 'Post-apocalíptico'
        ,'LA' => 'Literatura argentina'
        ,'FC' => 'Ficción surrealista'
    ];

    const EDITORIALES = [
         'AN' => 'Anaya'
        ,'MN' => 'Minotauro'
        ,'SD' => 'Sudamericana'
        ,'SW' => 'Secker & Warburg'
        ,'PL' => 'Planeta'
        ,'JB' => 'J.B. Lippincott & Co.'
        ,'PC' => 'Penguin Classics'
        ,'LH' => 'Lackington, Hughes, Harding, Mavor & Jones '
        ,'CS' => 'Charles Scribner\'s Sons'
        ,'HP' => 'HarperOne'
        ,'PJ' => 'Plaza & Janés'
        ,'GN' => 'Grupo Nelson'
        ,'RH' => 'Reynal & Hitchcock'
        ,'CC' => 'Cassell & Co.'
        ,'TM' => 'The Russian Messenger'
        ,'WL' => 'Ward, Lock & Co.'
        ,'VR' => 'Varios'
        ,'EP' => 'Ediciones Planeta'
        ,'SP' => 'Scholastic Press'
        ,'GA' => 'George Allen & Unwin'
        ,'FV' => 'S. Fischer Verlag'
        ,'CP' => 'Contact Publishing'
        ,'KN' => 'Knopf'
        ,'ES' => 'Editorial Sudamericana'
        ,'KW' => 'Kurt Wolff Verlag'
        
    ];
    */


    //
    static $cods_genero = [
         '' => ''
        ,'NV' => 'Novela'
        ,'SP' => 'Suspense'
        ,'FA' => 'Fantasía'
        ,'RM' => 'Realismo mágico'
        ,'CF' => 'Ciencia ficción'
        ,'NC' => 'Novela clásica'
        ,'FS' => 'Ficción social'
        ,'SP' => 'Suspenso'
        ,'RO' => 'Romántico'
        ,'TE' => 'Terror'
        ,'TR' => 'Tragedia'
        ,'FF' => 'Ficción filosófica'
        ,'HT' => 'Histórico'
        ,'RL' => 'Religión'
        ,'AV' => 'Aventura'
        ,'PS' => 'Psicológico'
        ,'FG' => 'Ficción gótica'
        ,'EP' => 'Épico'
        ,'PE' => 'Poesía épica'
        ,'MM' => 'Memorias'
        ,'PA' => 'Post-apocalíptico'
        ,'LA' => 'Literatura argentina'
        ,'FC' => 'Ficción surrealista'
    ];


}
