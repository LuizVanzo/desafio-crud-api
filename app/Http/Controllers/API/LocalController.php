<?php

namespace App\Http\Controllers\API;

/**
 * @OA\Tag(
 *     name="Local",
 *     description="Local CRUD endpoints"
 * )
 */

use App\Http\Controllers\Controller;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{


    /**
     * @OA\Get(
     *     path="/api/local",
     *     tags={"Local"},
     *     summary="List all locations",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filter by name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of locations"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Local::query();
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        return response()->json($query->get());
    }


    /**
     * @OA\Post(
     *     path="/api/local",
     *     tags={"Local"},
     *     summary="Create a new location",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","slug","city","state"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="slug", type="string"),
     *             @OA\Property(property="city", type="string"),
     *             @OA\Property(property="state", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Location created"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid data"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:local',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);
        $local = Local::create($data);
        return response()->json($local, 201);
    }


    /**
     * @OA\Get(
     *     path="/api/local/{id}",
     *     tags={"Local"},
     *     summary="Get location by ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Location ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location found"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found"
     *     )
     * )
     */
    public function show($id)
    {
        $local = Local::find($id);
        if (!$local) {
            return response()->json(['message' => 'Local not found'], 404);
        }
        return response()->json($local);
    }


    /**
     * @OA\Put(
     *     path="/api/local/{id}",
     *     tags={"Local"},
     *     summary="Update location by ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Location ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="slug", type="string"),
     *             @OA\Property(property="city", type="string"),
     *             @OA\Property(property="state", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location updated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $local = Local::find($id);
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
