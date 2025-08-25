<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    /**
     * Listar lugares, com filtro por nome
     */
    public function index(Request $request)
    {
        $query = \App\Models\Local::query();
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        return response()->json($query->get());
    }

    /**
     * Criar um lugar
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:local',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);
        $local = \App\Models\Local::create($data);
        return response()->json($local, 201);
    }

    /**
     * Obter um lugar específico
     */
    public function show($id)
    {
        $local = \App\Models\Local::find($id);
        if (!$local) {
            return response()->json(['message' => 'Local not found'], 404);
        }
        return response()->json($local);
    }

    /**
     * Editar um lugar
     */
    public function update(Request $request, $id)
    {
        $local = \App\Models\Local::find($id);
        if (!$local) {
            return response()->json(['message' => 'Local not found'], 404);
        }
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:local,slug,' . $id,
            'city' => 'sometimes|required|string|max:255',
            'state' => 'sometimes|required|string|max:255',
        ]);
        $local->update($data);
        return response()->json($local);
    }
}
