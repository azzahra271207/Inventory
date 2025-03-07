<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    // Menampilkan semua log
    public function index(Request $request)
    {
        // Mencari log berdasarkan query pencarian
        $query = $request->input('search');
        $logs = Log::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('action', 'LIKE', "%{$query}%")
                                 ->orWhere('table_name', 'LIKE', "%{$query}%")
                                 ->orWhere('ip_address', 'LIKE', "%{$query}%");
        })->orderBy('timestamp', 'desc')->paginate(10); // Menggunakan pagination

        return view('logs.index', compact('logs', 'query'));
    }

    // Menghapus log berdasarkan ID
    public function destroy($id)
    {
        $log = Log::findOrFail($id);
        $log->delete();

        return redirect()->route('logs.index')->with('success', 'Log berhasil dihapus.');
    }

    // Menghapus semua log
    public function clear()
    {
        Log::truncate(); // Menghapus semua log
        return redirect()->route('logs.index')->with('success', 'Semua log berhasil dihapus.');
    }
}