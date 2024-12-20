<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::orderBy('name', 'desc')->get();

        return view('produk.produk', [
            'produk' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('name', 'desc')->get();
        return view('produk.add', [
            'kategori' => $kategori,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:produk,name', // Cek unik di tabel produk
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'stock' => 'required',
            'price' => 'required',
            'description' => 'max:1000',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/produk';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Produk::create($input);

        Alert::success('Success', 'Produk has been saved !');
        return redirect('/produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        // Mencari produk berdasarkan ID
        $produk = Produk::find($produk->id);

        // Menampilkan view dan mengirim data produk
        return view('produk.view', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = produk::findOrFail($id);
        $kategori = Kategori::orderBy('name', 'asc')->get();

        return view('produk.edit', [
            'produk' => $produk,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // Validasi data, buat gambar opsional (nullable)
        $validated = $request->validate([
            'name' => 'required|max:100|unique:produk,name,' . $id . ',id',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',  // Nullable, agar gambar opsional
            'stock' => 'required',
            'price' => 'required',
            'description' => 'max:1000',
        ]);

        // Cek jika ada file gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($produk->image) {
                $oldImagePath = public_path('images/produk' . $produk->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images/produk'), $imageName);
            $validated['image'] = $imageName;
        } else {
            // Tetap gunakan gambar lama jika tidak ada gambar baru
            $validated['image'] = $produk->image;
        }

        // Update data produk
        $produk->update($validated);

        // Tampilkan pesan sukses
        Alert::info('Success', 'Produk has been updated!');
        return redirect('/produk');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $deletedproduk = Produk::findOrFail($id);
    
            // Hapus file gambar jika ada
            if ($deletedproduk->image) {
                $imagePath = public_path('images/produk' . $deletedproduk->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            $deletedproduk->delete();
    
            Alert::success('Success', 'Produk has been deleted !');
            return redirect('/produk');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, Produk already used !');
            return redirect('/produk');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('query');
        $produk = Produk::where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('category', 'LIKE', "%{$keyword}%")
            ->get();

        return response()->json($produk);
    }





}