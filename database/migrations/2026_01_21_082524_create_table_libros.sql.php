<?php
//Crear la migración: php artisan make:migration create_nombre_de_la_tabla_table
//Incluirla en la base de datos: php artisan migration
//Deshace las migraciones y las vuelve a ejecutar (se borrarán los datos del seeder): php artisan migrate:refresh
//Lo mismo que la anterior pero manteniendo los datos del seeder: php artisan migrate:refresh --seed

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Estructura de la tabla
        Schema::create('libros', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        //$table->char('editorial',2);
        $table->string('autor');
        $table->integer('anho');
        $table->char('genero');
        $table->text('descripcion');
        //$table->string('email')->unique();
        //$table->timestamp('email_verified_at')->nullable();
        //$table->string('password');
        //$table->rememberToken();
        //Auditoria
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('libros');
    }
};
