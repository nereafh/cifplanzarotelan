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

        // Crea el array 'datos' igual que en las otras funciones
        // Si viene de un destroy, 'session('exito')' tendrá el texto.
        $datos = [
            'exito' => session('exito', '') 
        ];

        return view('libros.index',['libros' => $libros,'cods_genero' => Libro::$cods_genero, 'datos' => $datos ]);// Pasar 'datos' a la vista]);
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
        $libro = new Libro();

        return view('libros.create',['datos' => $data,'libro' => $libro,'cods_genero' => Libro::$cods_genero, 'disabled' => '','oper' => 'create']);
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
        $datos = ['exito' => ''];
        $libro = Libro::find($id);

        return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => 'disabled','oper' => 'show']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id='')
    {
        //
        if ($request->isMethod('post')) {   

            $validated = $request->validate([
                'titulo'      => 'required|string|max:255',
                'autor'       => 'required|string|max:255',
                'anho'        => 'required|integer',
                'genero'      => 'required|string|max:255',
                'descripcion' => 'required|string|max:1255',
            ]);

            $datos_save = [];
            
            $datos_save['titulo']       = $request->input('titulo');;
            $datos_save['autor']        = $request->input('autor');;
            $datos_save['anho']         = $request->input('anho');;
            $datos_save['genero']       = $request->input('genero');;
            $datos_save['descripcion']  = $request->input('descripcion');


            Libro::where('id',$request->input('id'))->update($datos_save);
            
            $datos['exito'] = 'Operación realiza correctamente';
            $libro = new Libro();

        }
        else
        {
            $datos = ['exito' => ''];
            $libro = Libro::find($id);
        }

        return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => '','oper' => 'edit']);
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
        // 1. Buscar el libro
        $libro = Libro::findOrFail($id);
    
        // 2. Borrarlo
        $libro->delete();
    
        // 3. Redirigir al listado con un mensaje de éxito
        return redirect()->route('libro.index')->with('exito', 'Libro eliminado correctamente');    }
}


