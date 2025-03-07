<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Denda, Barang, Siswa, Peminjaman, Log}; // Optimasi import model
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $denda = Denda::with(['barang', 'siswa', 'peminjaman'])
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->whereHas('siswa', function ($q) use ($query) {
                    $q->where('nama_siswa', 'LIKE', "%{$query}%");
                })->orWhereHas('barang', function ($q) use ($query) {
                    $q->where('nama_barang', 'LIKE', "%{$query}%");
                });
            })->get();

        return view('denda.index', compact('denda', 'query'));
    }

    public function create()
    {
        $peminjaman = Peminjaman::where('status', 'denda')->get();
        return view('denda.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id_peminjaman',
            'jumlah_denda' => 'required|integer',
            'status' => 'required|in:belum dibayar,sudah dibayar',
        ]);

        $denda = Denda::create($request->all());

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'table_name' => 'denda',
            'old_value' => null,
            'new_value' => json_encode($denda),
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('denda.index')->with('success', 'Denda berhasil ditambahkan');
    }

    public function edit($id_denda)
    {
        $denda = Denda::findOrFail($id_denda);
        return view('denda.edit', compact('denda'));
    }

    public function update(Request $request, $id_denda)
    {
        $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id_peminjaman',
            'jumlah_denda' => 'required|integer',
            'status' => 'required|in:belum dibayar,sudah dibayar',
        ]);

        $denda = Denda::findOrFail($id_denda);
        $oldValue = $denda->toJson();
        $denda->update($request->all());

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'table_name' => 'denda',
            'old_value' => $oldValue,
            'new_value' => json_encode($denda),
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('denda.index')->with('success', 'Denda berhasil diperbarui');
    }

    public function destroy($id_denda)
    {
        $denda = Denda::findOrFail($id_denda);
        $oldValue = $denda->toJson();
        $denda->delete();

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'table_name' => 'denda',
            'old_value' => $oldValue,
            'new_value' => null,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('denda.index')->with('success', 'Denda berhasil dihapus');
    }

    public function print(Request $request)
    {
        $query = $request->input('query');
        $denda = Denda::with(['barang', 'siswa', 'peminjaman'])
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->whereHas('siswa', function ($q) use ($query) {
                    $q->where('nama_siswa', 'LIKE', "%{$query}%");
                })->orWhereHas('barang', function ($q) use ($query) {
                    $q->where('nama_barang', 'LIKE', "%{$query}%");
                });
            })->get();

        return view('denda.print', compact('denda'));
    }

    public function bayarDenda($id_denda)
    {
        $denda = Denda::findOrFail($id_denda);
        $denda->update(['status' => 'sudah dibayar']);
        return redirect()->route('denda.index')->with('success', 'Denda berhasil dibayar');
    }

    public function show($id_denda)
    {
        $denda = Denda::with(['barang', 'siswa', 'peminjaman'])->findOrFail($id_denda);
        return view('denda.show', compact('denda'));
    }

    public function getPeminjamanData($id_peminjaman)
    {
        $peminjaman = Peminjaman::with(['barang', 'siswa'])->findOrFail($id_peminjaman);
        
        return response()->json([
            'id_barang' => $peminjaman->id_barang,
            'nisn' => $peminjaman->nisn,
            'jumlah_pinjam' => $peminjaman->jumlah_pinjam,
        ]);
    }
}