<?php

//Crear controlador: php artisan make:controller NombreDelControlador
/*
Organiza la lógica de toda la app en métodos/funciones, manejan las peticiones HTTP y responden
Después ir a web.php a registrar las rutas 
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro; //Para usar el modelo libro

class LibroController extends Controller
{
    //
    public function index()
    {
        $libros = Libro::all();
        return view('libros.index', ['libros' => $libros]);
    }

    public function create(Request $request)
    {
        $data = ['exito' =>''];

        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'titulo'      => 'required|string|max:255',
                'autor'       => 'required|string|max:255',
                'anho'        => 'required|integer',
                'genero'      => 'required|string|max:255',
                'descripcion' => 'required|string|max:1255',
            ]);

            $libro = new Libro();

            
            $libro->titulo      = $request->input('titulo');;
            $libro->autor       = $request->input('autor');;
            $libro->anho        = $request->input('anho');;
            $libro->genero      = $request->input('genero');;
            $libro->descripcion = $request->input('descripcion');

            $libro->save();   
            
            $data['exito'] = 'Operación realiza correctamente';

        }


        return view('libros.create',['datos' => $data]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}


