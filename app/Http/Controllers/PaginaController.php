<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Pagina;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pagina::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'url' => 'required|string|max:255',
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
            ]);

            $pagina = Pagina::create([
                'url' => $request->url,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'usuariocreacion' => now(),
                'estado' => true,
                'tipo' => null,
            ]);
            return response()->json($pagina, 201);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagina $pagina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagina $pagina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pagina $pagina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagina $pagina)
    {
        //
    }
}
