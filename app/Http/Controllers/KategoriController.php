<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource. (READ)
     */
    public function index()
    {
        $kategoris = Kategori::all(); 
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage. (CREATE)
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori|max:255'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource. (Tidak kita pakai, kosongi saja)
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage. (UPDATE)
     */
    public function update(Request $request, string $id)
    {
       
        $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategoris,nama_kategori,'.$id
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/admin/kategori')->with('success', 'Nama kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage. (DELETE)
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        
       
        if ($kategori->produk()->count() > 0) {
            return redirect('/admin/kategori')->with('error', 'Gagal dihapus! Kategori ini masih memiliki beberapa daftar menu.');
        }

        $kategori->delete();
        return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus dari sistem!');
    }
}