<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Mienbro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MienbroController extends Controller
{
    public function index(){
        $mienbros = Mienbro::all()->sortByDesc('id');
        return view('mienbros.index',['mienbros'=>$mienbros]);
    }

    public function create(){
        $grados = Grado::all();
        return view('mienbros.create', compact('grados'));

    }

    public function store(Request $request){
        //$mienbro = request()->all();
        //return response()->json($mienbro);

        $request->validate([
           'nombre_completo' => 'required', 
           'grado_id' => 'required|exists:grados,id',
           'direccion' => 'required',
           'telefono' => 'required',
           'fecha_nacimiento' => 'required',
           'email' => 'required',
        ]);

        $mienbro = new Mienbro();
        
        $mienbro->nombre_completo = $request->nombre_completo;
        $mienbro->direccion = $request->direccion;
        $mienbro->telefono = $request->telefono;
        $mienbro->fecha_nacimiento = $request->fecha_nacimiento;
        $mienbro->genero = $request->genero;
        $mienbro->email = $request->email;
        $mienbro->grado_id = $request->grado_id;
        //$mienbro->fotografia = $resquest->fotografia;

        if($request->hasFile('fotografia')){
            $mienbro->fotografia = $request->file('fotografia')->store('fotografias_estudiantes', 'public');
        }
        $mienbro->save();

        return redirect()->route('mienbros.index')->with('mensaje', 'Se registro correctamente');
    }

    public function show($id)
    {
        $mienbro = Mienbro::findOrFail($id);
        
        return view('mienbros.show', ['mienbro' => $mienbro]);
    }    

    public function edit($id)
    {
        // Recuperar el mienbro con el ID proporcionado
        $mienbro = Mienbro::findOrFail($id);

        // Recuperar todos los grados disponibles
        $grados = Grado::all();

        // Pasar el mienbro y los grados a la vista
        return view('mienbros.edit', [
            'mienbro' => $mienbro,
            'grados' => $grados
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validar la entrada
        $request->validate([
            'nombre_completo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'email' => 'required',
            'grado_id' => 'required|exists:grados,id',  // Cambié 'grado' por 'grado_id' y validé que exista en la tabla 'grados'
        ]);

        // Recuperar el mienbro a editar
        $mienbro = Mienbro::find($id);

        // Asignar los valores de la solicitud al mienbro
        $mienbro->nombre_completo = $request->nombre_completo;
        $mienbro->direccion = $request->direccion;
        $mienbro->telefono = $request->telefono;
        $mienbro->fecha_nacimiento = $request->fecha_nacimiento;
        $mienbro->genero = $request->genero;
        $mienbro->email = $request->email;
        $mienbro->grado_id = $request->grado_id;  // Cambié 'grado' por 'grado_id'

        // Manejar la fotografía si es que se sube una nueva
        if ($request->hasFile('fotografia')) {
            // Eliminar la fotografía anterior si existe
            Storage::delete('public/' . $mienbro->fotografia);
            // Almacenar la nueva fotografía
            $mienbro->fotografia = $request->file('fotografia')->store('fotografias_estudiantes', 'public');
        }

        // Guardar los cambios en el modelo
        $mienbro->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('mienbros.index')->with('mensaje', 'Se actualizó correctamente');
    }


    public function destroy($id){
        Mienbro::destroy($id);

        return redirect()->route('mienbros.index')->with('mensaje', 'Se elimino correctamente');
    }
    
}
