<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('name', 'asc')->get();
        return response()->json($kategori);  // Mengembalikan data kategori dalam bentuk JSON
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:kategori,name',
        ]);

        $input = $request->all();
        $kategori = Kategori::create($input);

        return response()->json([
            'status' => true,
            'message' => 'Kategori has been saved!',
            'data' => $kategori,
        ], 201); // Mengembalikan status dan data kategori yang disimpan
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori); // Menampilkan kategori berdasarkan ID
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:100|unique:kategori,name,' . $id . ',id',
        ]);

        $kategori->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Kategori has been updated!',
            'data' => $kategori,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();

            return response()->json([
                'status' => true,
                'message' => 'Kategori has been deleted!',
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Kategori cannot be deleted, it is in use!',
            ], 400);
        }
    }

    /**
     * Search categories.
     */
    public function search(Request $request)
    {
        $keyword = $request->input('query');
        $kategori = Kategori::where('name', 'LIKE', "%{$keyword}%")->get();
        return response()->json($kategori);
    }
}
