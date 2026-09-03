<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{

    public function feedCalendario()
    {
        $atividades = Atividade::all();

        $eventos = collect();

        foreach ($atividades as $item) {
            $vezes = ($item->recorrente && $item->recorrencia > 0)
                ? $item->recorrencia
                : 1;

            for ($i = 0; $i < $vezes; $i++) {
                // pega a data original e soma $i semanas
                $dataOcorrencia = Carbon::parse($item->data)->addWeeks($i);

                $eventos->push([
                    'id'    => $i === 0 ? (string) $item->id : $item->id . '-' . $i,
                    'title' => $item->nome,
                    'start' => $dataOcorrencia->format('Y-m-d') . 'T' . $item->hora_inicio,
                    'end'   => $dataOcorrencia->format('Y-m-d') . 'T' . $item->hora_fim,
                    'extendedProps' => [
                        'descricao'   => $item->descricao,
                        'data'        => $dataOcorrencia->format('d/m/Y'),
                        'hora_inicio' => $item->hora_inicio,
                        'hora_fim'    => $item->hora_fim,
                        'recorrente'  => $item->recorrente,
                        'recorrencia' => $item->recorrencia,
                    ],
                ]);
            }
        }

        return response()->json($eventos);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Atividade::all();
        return view('atividade.index', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('atividade.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Atividade::create($request->except('_token'));
        return to_route("atividades.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $atividade = Atividade::find($id);
        return view("atividades.show", compact('atividade'));
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
            $validated = $request->validate([
            'nome'        => 'required|string|max:255',
            'descricao'   => 'nullable|string',
            'data'        => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim'    => 'required',
        ]);

        $atividade = Atividade::findOrFail($id);
        $atividade->update($validated);

        return response()->json(['sucesso' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Atividade::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
