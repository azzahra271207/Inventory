<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Log; 
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $barang = Barang::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nama_barang', 'LIKE', "%{$query}%")
                                ->orWhere('kategori', 'LIKE', "%{$query}%")
                                ->orWhere('kondisi', 'LIKE', "%{$query}%"); // Tambahkan pencarian untuk kondisi
        })->get();

        return view('barang.index', compact('barang', 'query'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|in:cacat,tidak cacat', // Validasi untuk kondisi
        ]);
    
        $barang = Barang::create($request->all());
    
        // Menyimpan log aktivitas
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'table_name' => 'barang',
            'old_value' => null,
            'new_value' => json_encode($barang),
            'ip_address' => request()->ip(),
        ]);
    
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan');
    }

    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang); // Mencari barang berdasarkan ID
        return view('barang.edit', compact('barang')); // Mengembalikan view edit dengan data barang
    }

    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|in:cacat,tidak cacat', // Validasi untuk kondisi
        ]);
    
        $barang = Barang::findOrFail($id_barang);
        $oldValue = $barang->toJson(); // Simpan nilai lama sebelum diubah
        $barang->update($request->all());
    
        // Menyimpan log aktivitas
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'table_name' => 'barang',
            'old_value' => $oldValue,
            'new_value' => json_encode($barang),
            'ip_address' => request()->ip(),
        ]);
    
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
    }

    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $oldValue = $barang->toJson(); // Simpan nilai lama sebelum dihapus

        // Menyimpan log aktivitas
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'table_name' => 'barang',
            'old_value' => $oldValue,
            'new_value' => null,
            'ip_address' => request()->ip(),
        ]);

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
    }

    public function print(Request $request)
    {
        $query = $request->input('query');
        $barang = Barang::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nama_barang', 'LIKE', "%{$query}%")
                                 ->orWhere('kategori', 'LIKE', "%{$query}%")
                                 ->orWhere('kondisi', 'LIKE', "%{$query}%"); // Tambahkan pencarian untuk kondisi
        })->get();

        return view('barang.print', compact('barang'));
    }
}