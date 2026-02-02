<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;

class SocioController extends Controller
{
    /**
     * Listado principal de socios
     */
    public function index()
    {
        $socios = Socio::paginate(10);
        // Pasamos el array de categorías definido en el modelo
        return view('socios.index', ['socios' => $socios, 'categorias' => Socio::$categorias
        ]);
    }

    /**
     * Crear un nuevo socio (GET para mostrar, POST para guardar)
     */
    public function create(Request $request)
    {
        $socio = new Socio();
        $datos = ['exito' => ''];
        $disabled = '';
        $oper = 'create';
        $categorias = Socio::$categorias;

        if ($request->isMethod('post')) {
            try {
                $request->validate([
                    'nombre'    => 'required|string|max:255',
                    'dni'       => 'required|string|unique:socios,dni|max:10',
                    'edad'      => 'required|integer|min:18',
                    'categoria' => 'required|string',
                    'iban'      => ['required', 'regex:/^ES\d{22}$/'],
                ], [
                    'nombre.required' => 'El nombre es obligatorio.',
                    'nombre.required' => 'El nombre es obligatorio.',
                    'dni.unique'      => 'Este DNI ya está registrado.',
                    'dni.required' => 'El dni es obligatorio.',
                    'edad.required' => 'La edad es obligatoria.',
                    'edad.min'        => 'El socio debe ser mayor de edad.',
                    'categoria.required' => 'La categoria es obligatoria.',
                    'iban.required' => 'El iban es obligatorio.',
                ]);

                $socio->nombre    = $request->input('nombre');
                $socio->dni       = $request->input('dni');
                $socio->edad      = $request->input('edad');
                $socio->categoria = $request->input('categoria');
                $socio->iban      = $request->input('iban');
                $socio->save();

                $datos['exito'] = 'Socio dado de alta correctamente';
                $disabled = 'disabled';

            } catch (\Illuminate\Validation\ValidationException $e) {
                if ($request->input('modo') == 'ajax') {
                    return view('socios.create', [
                        'socio' => $socio,
                        'datos' => $datos,
                        'disabled' => $disabled,
                        'categorias' => $categorias,
                        'oper' => $oper
                    ])->withErrors($e->validator)->render();
                }
            }
        }
        $categorias = Socio::$categorias;
        if ($request->input('modo') == 'ajax') {
            return view('socios.create', compact('socio', 'datos', 'disabled', 'oper', 'categorias'))->render();
        }

        return view('socios.create', compact('socio', 'datos', 'disabled', 'oper', 'categorias'));
    }

    /**
     * Ver un socio (Modo lectura)
     */
    public function show(string $id, Request $request)
    {
        $socio = Socio::find($id);
        $categorias = Socio::$categorias;
        $datos = ['exito' => ''];

        if ($request->input('modo') == 'ajax') {
            return view('socios.create', ['socio' => $socio, 'datos' => $datos, 'categorias' => $categorias, 'disabled' => 'disabled', 'oper' => 'show'])->render();
        }
        return view('socios.create', ['socio' => $socio, 'datos' => $datos, 'categorias' => $categorias, 'disabled' => 'disabled', 'oper' => 'show']);
    }
    /**
     * Editar un socio
     */
    public function edit(Request $request, $id = '')
    {
        $id_actual = $id ?: $request->input('id_actual');
        $socio = Socio::findOrFail($id_actual);
        $datos = ['exito' => ''];
        $disabled = '';
        $oper = 'edit';
        $categorias = Socio::$categorias;

        if ($request->isMethod('post')) {
            try {
                $request->validate([
                    'nombre'    => 'required|string|max:255',
                    'dni'       => 'required|string|max:10|unique:socios,dni,'.$socio->id,
                    'edad'      => 'required|integer',
                    'categoria' => 'required|string',
                    'iban'      => 'required|string',
                ],
                [
                    'nombre.regex' => 'El nombre debe comenzar por una letra mayúscula.',
                    'nombre.required' => 'El nombre es obligatorio.',
                    'dni.required' => 'El DNI es obligatorio.',
                    'dni.unique' => 'Este DNI ya existe.',
                    'edad.required'   => 'La edad es obligatoria.',
                    'edad.numeric'    => 'La edad debe ser un número.',
                    'edad.min'        => 'El socio debe ser mayor de edad.',
                    'categoria.required' => 'La categoría es obligatoria.',
                    'iban.required' => 'El IBAN es obligatorio.',
                    'iban.regex' => 'El IBAN debe ser ES + 22 dígitos.'
                ]);

                $socio->nombre    = $request->input('nombre');
                $socio->dni       = $request->input('dni');
                $socio->edad      = $request->input('edad');
                $socio->categoria = $request->input('categoria');
                $socio->iban      = $request->input('iban');
                $socio->save();  

                $datos['exito'] = 'Operación realizada correctamente';
                $disabled = 'disabled';

            } catch (\Illuminate\Validation\ValidationException $e) {
                if ($request->input('modo') == 'ajax') {
                return view('socios.create', [
                    'socio' => $socio,
                    'datos' => $datos,
                    'disabled' => $disabled,
                    'categorias' => $categorias,
                    'oper' => $oper
                ])->withErrors($e->validator)->render();
            }
            }
        }

        if ($request->input('modo') == 'ajax') {
            return view('socios.create', compact('socio', 'datos', 'categorias', 'disabled'))->with('oper', 'edit')->render();
        }
        return view('socios.create', compact('socio', 'datos', 'categorias', 'disabled'))->with('oper', 'edit');
    }

    /**
     * Borrar un socio
     */
    public function destroy(Request $request, string $id = '')
    {
        // 1. Buscamos el ID en la URL ($id) o en el formulario ('id_actual')
        $id_actual = $id ?: $request->input('id_actual');
        $socio = Socio::find($id_actual);
        
        $oper = 'destroy';
        $categorias = Socio::$categorias;
        $disabled = 'disabled'; // Siempre deshabilitado en borrado
        $datos = ['exito' => ''];
    
        if ($request->isMethod('post')) {
            if ($socio) { 
                $socio->delete(); 
                $datos['exito'] = 'Socio eliminado correctamente';
                
                // Creamos un objeto vacío para que el formulario no de error al recargarse
                $socio = new Socio(); 
            }
    
            if ($request->input('modo') == 'ajax') {
                return view('socios.create', compact('socio', 'datos', 'categorias', 'disabled', 'oper'))->render();
            }
            return redirect()->route('socio.index');
        }
    
        // Retorno para cargar el modal (GET)
        if ($request->input('modo') == 'ajax') {
            return view('socios.create', compact('socio', 'datos', 'categorias', 'disabled', 'oper'))->render();
        }
        return view('socios.create', compact('socio', 'datos', 'categorias', 'disabled', 'oper'));
    }
}