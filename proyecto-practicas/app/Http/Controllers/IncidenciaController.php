<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    public function show(Incidencia $incidencia)
    {
        return view('documentacion.incidencias.show', compact('incidencia'));
    }
}
