<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.master.golongan.index', [
            'title' => 'Daftar Golongan',
            'golongans' => Golongan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.master.golongan.create', [
            'title' => 'Tambah Golongan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3|max:100',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Golongan::class, 'slug', $request->nama);
        $validatedData['author_id'] = auth()->user()->id;
        
        Golongan::create($validatedData);
        return redirect()->route('golongan.index')->with('success', 'Golongan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Golongan $golongan)
    {
        return view('dashboard.master.golongan.show', [
            'title' => 'Detail Golongan',
            'golongan' => $golongan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Golongan $golongan)
    {
        return view('dashboard.master.golongan.edit', [
            'title' => 'Perbarui Golongan',
            'golongan' => $golongan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Golongan $golongan)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3|max:100',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Golongan::class, 'slug', $request->nama);
        $validatedData['author_id'] = auth()->user()->id;
        
        Golongan::where('id', $golongan->id)->update($validatedData);
        return redirect()->route('golongan.index')->with('success', 'Golongan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Golongan $golongan)
    {
        $golongan->delete();
        return redirect()->route('golongan.index')->with('success', 'Golongan berhasil dihapus!');
    }
}
