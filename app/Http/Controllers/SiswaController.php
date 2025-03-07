<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Log; // Import model Log
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $siswa = Siswa::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nama_siswa', 'LIKE', "%{$query}%")
                                 ->orWhere('kelas', 'LIKE', "%{$query}%")
                                 ->orWhere('jurusan', 'LIKE', "%{$query}%");
        })->get();

        return view('siswa.index', compact('siswa', 'query'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:255|unique:siswa,nisn',
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        // Menyimpan data siswa
        $siswa = Siswa::create($request->all());

        // Menyimpan log aktivitas
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'table_name' => 'siswa',
            'old_value' => null,
            'new_value' => json_encode($siswa),
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $nisn)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
        $oldValue = $siswa->toJson(); // Simpan nilai lama sebelum diubah
        $siswa->update($request->only(['nama_siswa', 'kelas', 'jurusan']));

        // Menyimpan log aktivitas
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'table_name' => 'siswa',
            'old_value' => $oldValue,
            'new_value' => json_encode($siswa),
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
        $oldValue = $siswa->toJson(); // Simpan nilai lama sebelum dihapus

        // Menyimpan log aktivitas
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'table_name' => 'siswa',
            'old_value' => $oldValue,
            'new_value' => null,
            'ip_address' => request()->ip(),
        ]);

        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }

    public function print(Request $request)
    {
        $query = $request->input('query');
        $siswa = Siswa::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nama_siswa', 'LIKE', "%{$query}%")
                                 ->orWhere('kelas', 'LIKE', "%{$query}%")
                                 ->orWhere('jurusan', 'LIKE', "%{$query}%");
        })->get();
    
        return view('siswa.print', compact('siswa', 'query'));
    }
}