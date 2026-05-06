<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Visitante;
use App\Models\Log;
use Exception;
use Illuminate\Http\Request;

class logController extends Controller
{
    public function index()
    {
        $logs = Log::with('visitante')
            ->latest()
            ->get();

        return view('inicio', compact('logs'));
    }

    public function store(Request $request)
    {
        //SE VALIDA LA ENTRADA
        $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'tipo_usuario' => 'required',
            'actividad' => 'required'

        ]);

        //CREA O ACTUALIZA AL VISITANTE
        $visitor = Visitante::updateOrCreate(
            [
                'cedula' => $request->cedula
            ],
            [
                'nombre' => $request->nombre,
                'tipo_usuario' => $request->tipo_usuario
            ]
        );

        //BUSCA SI YA TIENE ENTRADA SIN SALIDA
        $openLog = Log::where('id_visitante', $visitor->id)
            ->whereNull('hora_salida')
            ->latest()
            ->first();

        // SI YA ESTÁ DENTRO → REGISTRAR SALIDA
        if ($openLog) {

            $openLog->update([
                'hora_salida' => now()
            ]);

            return back()->with('success', 'Salida registrada correctamente');
        }

        // SI NO ESTÁ DENTRO → REGISTRAR ENTRADA
        Log::create([
            'id_visitante' => $visitor->id,
            'actividad' => $request->actividad,
            'hora_entrada' => now()
        ]);

        return back()->with('success', 'Entrada registrada correctamente');
    }

    public function marcarSalida($id)
    {

        $openLog = Log::where('id_visitante', $id)
            ->whereNull('hora_salida')
            ->latest()
            ->first();

        if ($openLog) {
            $openLog->update([
                'hora_salida' => now()
            ]);
            return back()->with('success', 'Salida registrada correctamente');
        } else {

        }

    }

}
