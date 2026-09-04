<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan with('user') untuk memuat relasi user (mencegah N+1 query)
        $jenis = Jenis::with('user')->latest()->get();

        return view('jenis.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama,
            'user_id'    => Auth::id(), // Menyimpan ID user yang sedang login
        ]);

        return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jeni)
    {
        return view('jenis.show', ['jenis' => $jeni]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jeni)
    {
        return view('jenis.edit', ['jenis' => $jeni]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis $jeni)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $jeni->update([
            'nama_jenis' => $request->nama,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jeni)
    {
        $jeni->delete();

        return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil dihapus!');
    }
}