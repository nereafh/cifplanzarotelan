<?php

//Crear controlador: php artisan make:controller NombreDelControlador
/*
Organiza la lógica de toda la app en métodos/funciones, manejan las peticiones HTTP y responden
Después ir a web.php a registrar las rutas 
*/

/*
Después de hacer los cambios, limpia la caché para que Laravel los reconozca:
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan optimize:clear
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro; //Para usar el modelo libro

class LibroController extends Controller
{
    //
    public function index()
    {
        $libros = Libro::paginate(10);
        return view('libros.index',['libros' => $libros,'cods_genero' => Libro::$cods_genero]);
    }

    public function create(Request $request)
    {
        $libro = new Libro(); // O el modelo que use
        $datos = ['exito' => ''];
        $disabled = ''; 
        $oper = 'create';
        $cods_genero = Libro::$cods_genero;

        if ($request->isMethod('post')) {
            try {
            $validated = $request->validate([
                'titulo'      => 'required|string|max:255',
                'autor'       => 'required|string|max:255',
                'anho'        => 'required|integer',
                'genero'      => 'required|string|max:255',
                'descripcion' => 'required|string|max:1255',
            ], 
            [
                'titulo.required' => 'El título es obligatorio.',
                'autor.required'  => 'El autor es obligatorio.',
                'anho.required'   => 'El año es obligatorio.',
                'genero.required'   => 'El géner es obligatorio.',
                'descripcion.required'   => 'La descripción es obligatoria.',
            ]);

            $libro = new Libro();
            
            $libro->titulo      = $request->input('titulo');;
            $libro->autor       = $request->input('autor');;
            $libro->anho        = $request->input('anho');;
            $libro->genero      = $request->input('genero');;
            $libro->descripcion = $request->input('descripcion');
            $libro->save();   
            
            $datos['exito'] = 'Operación realiza correctamente';
            $disabled = 'disabled';

            } catch (\Illuminate\Validation\ValidationException $e) {
            // SI FALLA LA VALIDACIÓN Y ES AJAX: Devolvemos SOLO el formulario
            if ($request->input('modo') == 'ajax') {
                return view('libros.create', compact('libro', 'datos', 'disabled', 'oper', 'cods_genero'))
                       ->withErrors($e->validator)
                       ->render(); // Importante el render() para enviar solo HTML parcial
            }
        }
    }
            // SI ES PETICIÓN INICIAL (GET) Y ES AJAX
            if ($request->input('modo') == 'ajax') {
                return view('libros.create', ['datos' => $datos, 'libro' => $libro, 'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled, 'oper' => 'create'])->render();
            }

        
        $libro = new Libro();
        if ($request->input('modo') == 'ajax') {
            return view('libros.create', ['datos' => $datos, 'libro' => $libro, 'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled, 'oper' => 'create'])->render();
        }

        return view('libros.create',['datos' => $datos,'libro' => $libro,'cods_genero' => Libro::$cods_genero, 'disabled' => '','oper' => 'create']);
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
    public function show(string $id, Request $request)
    {
        //
        $datos = ['exito' => ''];
        $libro = Libro::find($id);

        if ($request->input('modo') == 'ajax') {
            return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => 'disabled','oper' => 'show'])->render();
        }
        return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => 'disabled','oper' => 'show']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id='')
    {
        //
        // 1. Buscamos el libro (ya sea por URL o por el campo oculto del formulario)
        $id_actual = $id ?: $request->input('id');
        $libro = Libro::find($id_actual);
        $datos = ['exito' => ''];
        $disabled = ''; 
        $oper = 'edit';
        $cods_genero = Libro::$cods_genero;

        if ($request->isMethod('post')) {   
            try {
            $validated = $request->validate([
                'titulo'      => 'required|string|max:255',
                'autor'       => 'required|string|max:255',
                'anho'        => 'required|integer',
                'genero'      => 'required|string|max:255',
                'descripcion' => 'required|string|max:1255',
            ], 
            [
                'titulo.required' => 'El título es obligatorio.',
                'autor.required'  => 'El autor es obligatorio.',
                'anho.required'   => 'El año es obligatorio.',
                'genero.required'   => 'El géner es obligatorio.',
                'descripcion.required'   => 'La descripción es obligatoria.',
            ]);

            /*
            $datos_save = [];
            
            $datos_save['titulo']       = $request->input('titulo');;
            $datos_save['autor']        = $request->input('autor');;
            $datos_save['anho']         = $request->input('anho');;
            $datos_save['genero']       = $request->input('genero');;
            $datos_save['descripcion']  = $request->input('descripcion');


            Libro::where('id',$request->input('id'))->update($datos_save);
            */
            $libro = Libro::find($request->input('id'));

            
            $libro->titulo      = $request->input('titulo');;
            $libro->autor       = $request->input('autor');;
            $libro->anho        = $request->input('anho');;
            $libro->genero      = $request->input('genero');;
            $libro->descripcion = $request->input('descripcion');
            $libro->save();   
            
            $datos['exito'] = 'Operación realiza correctamente';
            $disabled = 'disabled';

            } catch (\Illuminate\Validation\ValidationException $e) {
            // 4. Si falla la validación en AJAX, devolvemos SOLO el trozo del formulario
            if ($request->input('modo') == 'ajax') {
                return view('libros.create', compact('libro', 'datos', 'disabled', 'oper', 'cods_genero'))
                       ->withErrors($e->validator)
                       ->render();
            }
        }
    }
            
    // Retorno para GET (Carga inicial con datos) o POST exitoso
    if ($request->input('modo') == 'ajax') {
        return view('libros.create', compact('libro', 'datos', 'disabled', 'oper', 'cods_genero'))->render();
    }
    
    return view('libros.create', compact('libro', 'datos', 'disabled', 'oper', 'cods_genero'));    }

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
    public function destroy(Request $request,string $id='')
    {
        $id_actual = $id ?: $request->input('id');
        $libro = Libro::find($id_actual);
       if ($request->isMethod('post')) {   

            /*
            $datos_save = [];
            
            $datos_save['titulo']       = $request->input('titulo');;
            $datos_save['autor']        = $request->input('autor');;
            $datos_save['anho']         = $request->input('anho');;
            $datos_save['genero']       = $request->input('genero');;
            $datos_save['descripcion']  = $request->input('descripcion');


            Libro::where('id',$request->input('id'))->update($datos_save);

            */

            if ($libro) { $libro->delete(); }
            $datos = ['exito' => 'Operación realizada correctamente'];
            
            if ($request->input('modo') == 'ajax') {
                return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => 'disabled','oper' => 'destroy'])->render();
            }
            return redirect()->route('libro.index');
        }
        else
        {
            $datos = ['exito' => ''];
            if ($request->input('modo') == 'ajax') {
                return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => 'disabled','oper' => 'destroy'])->render();
            }
            $libro = Libro::find($id);
            $disabled = 'disabled';

            return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled,'oper' => 'destroy']);
        }



  }
}


