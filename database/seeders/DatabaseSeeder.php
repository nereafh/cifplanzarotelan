<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Esto significa: "Si no existe, créalo. Si existe, no hagas nada"
        User::firstOrCreate(
            ['email' => 'juan_curbelo@cifpzonzamas.es'],
            [
                'name' => 'juanra',
                'password' => Hash::make('password'),
            ]
        );
    
        // Con los libros podemos hacer lo mismo o simplemente comentar la línea
        // una vez que ya tengamos datos en la tabla.
        $this->call(LibrosSeeder::class);
    }
}
