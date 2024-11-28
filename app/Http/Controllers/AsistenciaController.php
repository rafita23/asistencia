<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Mienbro;
use App\Models\Grado;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $grados = Grado::all();
        return view('asistencias.index', compact('grados'));
    }

    public function getEstudiantesPorGrado($gradoId)
    {
        // Buscar los miembros por grado
        $estudiantes = Mienbro::where('grado_id', $gradoId)->get();

        // Retornar los datos como JSON
        return response()->json($estudiantes);
    }

    public function getAsistenciasPorFechaYGrado($gradoId, $fecha)
    {
        try {
            $fecha = \Carbon\Carbon::parse($fecha)->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fecha no válida'], 400);
        }

        $mienbros = Mienbro::where('grado_id', $gradoId)->get();
        $asistencias = Asistencia::where('fecha', $fecha)
            ->whereIn('mienbro_id', $mienbros->pluck('id'))
            ->get();

        $datos = $mienbros->map(function ($mienbro) use ($asistencias, $fecha) {
            $asistencia = $asistencias->where('mienbro_id', $mienbro->id)->first();
            return [
                'id' => $mienbro->id,
                'nombre_completo' => $mienbro->nombre_completo,
                'telefono' => $mienbro->telefono ?? 'Sin teléfono',
                'asistio' => $asistencia ? $asistencia->asistio : false,
            ];
        });

        return response()->json($datos);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'asistencia' => 'required|array',
            'asistencia.*.mienbro_id' => 'required|exists:mienbros,id',
            'asistencia.*.asistio' => 'nullable|boolean',
        ]);

        foreach ($data['asistencia'] as $registro) {
            Asistencia::updateOrCreate(
                [
                    'mienbro_id' => $registro['mienbro_id'],
                    'fecha' => now()->toDateString(),
                ],
                [
                    'asistio' => $registro['asistio'] ?? false,
                ]
            );
        }

        return response()->json(['success' => 'Asistencia registrada correctamente.']);
    }

    public function show()
    {
        $grados = Grado::all();
        return view('asistencias.show', compact('grados'));
    }
}
