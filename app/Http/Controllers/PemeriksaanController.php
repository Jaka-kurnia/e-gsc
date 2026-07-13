<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pemeriksaan'] = Pemeriksaan::with(['jadwal', 'anak', 'user', 'approvedBy'])->paginate(4);
        return view('Pemeriksaan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'anak_id' => 'required',
            'jadwal_id' => 'required',
            'nomer_pemeriksaan' => 'required',
            'approved_by' => 'required',
            'tanggal_kunjungan' => 'required',
            'metode_kunjungan' => 'required',
            'umur_bulan' => 'required',
            'approvel_status' => 'required',
        ], []);

        Pemeriksaan::create($validated);
        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        return response()->json($pemeriksaan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'anak_id' => 'required',
            'jadwal_id' => 'required',
            'nomer_pemeriksaan' => 'required',
            'approved_by' => 'required',
            'tanggal_kunjungan' => 'required',
            'metode_kunjungan' => 'required',
            'umur_bulan' => 'required',
            'approvel_status' => 'required',
        ], []);

        $pemeriksaan->update($validated);
        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();
        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan Berhasil Dihapus');
    }
}
