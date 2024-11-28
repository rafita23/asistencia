<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grados = Grado::all()->sortByDesc('id');
        return view('grados.index', ['grados' => $grados]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_curso' => 'required', 
            'otro1' => 'required',
            'otro2' => 'required',
            'otro3' => 'required',
         ]);
 
         $grado = new Grado();
         
         $grado->nombre_curso = $request->nombre_curso;
         $grado->otro1 = $request->otro1;
         $grado->otro2 = $request->otro2;
         $grado->otro3 = $request->otro3;

         $grado->save();
 
         return redirect()->route('grados.index')->with('mensaje', 'Se registro correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $grado = Grado::findOrFail($id);
        return view('grados.show', ['grado' => $grado]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $grado = Grado::findOrFail($id);

        return view('grados.edit',['grado' => $grado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_curso' => 'required', 
            'otro1' => 'required',
            'otro2' => 'required',
            'otro3' => 'required',
         ]);

        $grado = Grado::find($id);

        $grado->nombre_curso = $request->nombre_curso;
        $grado->otro1 = $request->otro1;
        $grado->otro2 = $request->otro2;
        $grado->otro3 = $request->otro3;

        $grado->save();

        return redirect()->route('grados.index')->with('mensaje', 'Se actualizo correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Grado::destroy($id);
        return redirect()->route('grados.index')->with('mensaje', 'Se elimino correctamente');
    }
}
