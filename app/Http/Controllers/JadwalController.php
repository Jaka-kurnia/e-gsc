<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data['jadwal'] = Jadwal::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_kegiatan', 'like', "%{$search}%")
                        ->orWhere('tanggal_kegiatan', 'like', "%{$search}%")
                        ->orWhere('catatan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('Jadwal.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_kegiatan' => 'required|date',
            'nama_kegiatan' => 'required|string|max:255',
            'status_logistik' => 'required|in:Belum Siap,Siap',
            'catatan' => 'nullable|string',
        ], [
            'tanggal_kegiatan.required' => 'Tanggal kegiatan harus diisi.',
            'tanggal_kegiatan.date' => 'Format tanggal tidak valid.',
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'status_logistik.required' => 'Status logistik harus dipilih.',
            'status_logistik.in' => 'Status logistik tidak valid.',
        ]);

        Jadwal::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal)
    {
        //
    }

    public function edit(Jadwal $jadwal)
    {
        return response()->json($jadwal);
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'tanggal_kegiatan' => 'required|date',
            'nama_kegiatan' => 'required|string|max:255',
            'status_logistik' => 'required|in:Belum Siap,Siap',
            'catatan' => 'nullable|string',
        ], [
            'tanggal_kegiatan.required' => 'Tanggal kegiatan harus diisi.',
            'tanggal_kegiatan.date' => 'Format tanggal tidak valid.',
            'nama_kegiatan.required' => 'Nama kegiatan harus diisi.',
            'status_logistik.required' => 'Status logistik harus dipilih.',
            'status_logistik.in' => 'Status logistik tidak valid.',
        ]);

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil dihapus.');
    }
}
