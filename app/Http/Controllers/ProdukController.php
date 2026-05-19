<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Tampilan utama produk untuk Admin 
     */
    public function indexAdmin(Request $request) 
    {
        $search = $request->query('search');
        
        $query = Produk::with('kategori')
            ->when($search, function($query, $search) {
                return $query->where('nama_produk', 'like', "%{$search}%");
            });

        if ($request->has('printAll')) {
            $produks = $query->get(); 
        } else {
            $produks = $query->paginate(5); 
        }

      
        $totalVarian = Produk::count();
        $stokKritis = Produk::where('stok', '<', 30)->count();
        $totalKategori = Kategori::count();

        return view('admin.produk.index', compact('produks', 'search', 'totalVarian', 'stokKritis', 'totalKategori'));
    }

    /**
     * Form Tambah Produk
     */
    public function create() 
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    /**
     * Simpan Produk Baru ke Database
     */
    public function store(Request $request) 
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Produk::create($data);
        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Form Edit Produk
     */
    public function edit($id) 
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update Data Produk di Database
     */
    public function update(Request $request, $id) 
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            if($produk->image && file_exists(public_path('images/'.$produk->image))) {
                unlink(public_path('images/'.$produk->image));
            }
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $produk->update($data);
        return redirect('/admin/produk')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus Produk 
     */
    public function destroy($id) 
    {
        $produk = Produk::findOrFail($id);
        
        if ($produk->image && file_exists(public_path('images/' . $produk->image))) {
            unlink(public_path('images/' . $produk->image));
        }

        $produk->delete();
        return redirect('/admin/produk')->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Tampilan utama produk untuk User/Kasir 
     */
    public function indexUser(Request $request) 
    {
        $search = $request->get('search');
        $query = Produk::with('kategori');

        if (!empty($search)) {
            $query->where('nama_produk', 'LIKE', '%' . $search . '%');
        }

        if ($request->has('printAll')) {
            $produks = $query->get(); 
        } else {
            $produks = $query->paginate(5); 
        }


        $totalVarian = Produk::count();
        $stokKritis = Produk::where('stok', '<', 30)->count();
        $totalKategori = Kategori::count();

        return view('user.produk', compact('produks', 'search', 'totalVarian', 'stokKritis', 'totalKategori'));
    }
}