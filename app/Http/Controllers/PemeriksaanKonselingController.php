<?php

namespace App\Http\Controllers;

use App\Exports\PemeriksaanKonselingExport;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanKonseling;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanKonselingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pemeriksaanKonseling = PemeriksaanKonseling::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user'])
            ->when($search, function ($query, $search) {
                $query->whereHas('pemeriksaan.anak', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('pemeriksaan', function ($q) use ($search) {
                    $q->where('nomor_pemeriksaan', 'like', "%{$search}%");
                });
            })
            ->paginate(4)
            ->withQueryString();

        $pemeriksaans = Pemeriksaan::all();
        $users = User::all();

        return view('PemeriksaanKonseling.index', compact('pemeriksaanKonseling', 'pemeriksaans', 'users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemeriksaan_id' => 'required|exists:pemeriksaans,id',
            'user_id' => 'nullable|exists:users,id',
            'konseling' => 'required|string',
            'pemberian_pmt' => 'nullable|boolean',
        ], [
            'pemeriksaan_id.required' => 'Pemeriksaan harus dipilih.',
            'pemeriksaan_id.exists' => 'Pemeriksaan yang dipilih tidak valid.',
            'konseling.required' => 'Catatan Konseling harus diisi.',
            'pemberian_pmt.boolean' => 'Pemberian PMT tidak valid.',
        ]);

        $validated['pemberian_pmt'] = $request->boolean('pemberian_pmt');

        PemeriksaanKonseling::create($validated);

        return redirect()->route('pemeriksaan_konseling.index')->with('success', 'Data Pemeriksaan Konseling berhasil ditambahkan.');
    }

    public function show(PemeriksaanKonseling $pemeriksaanKonseling)
    {
        //
    }

    public function edit(PemeriksaanKonseling $pemeriksaanKonseling)
    {
        $pemeriksaanKonseling->load(['pemeriksaan', 'user']);
        return response()->json($pemeriksaanKonseling);
    }

    public function update(Request $request, PemeriksaanKonseling $pemeriksaanKonseling)
    {
        $validated = $request->validate([
            'pemeriksaan_id' => 'required|exists:pemeriksaans,id',
            'user_id' => 'nullable|exists:users,id',
            'konseling' => 'required|string',
            'pemberian_pmt' => 'nullable|boolean',
        ], [
            'pemeriksaan_id.required' => 'Pemeriksaan harus dipilih.',
            'pemeriksaan_id.exists' => 'Pemeriksaan yang dipilih tidak valid.',
            'konseling.required' => 'Catatan Konseling harus diisi.',
            'pemberian_pmt.boolean' => 'Pemberian PMT tidak valid.',
        ]);

        $validated['pemberian_pmt'] = $request->boolean('pemberian_pmt');

        $pemeriksaanKonseling->update($validated);

        return redirect()->route('pemeriksaan_konseling.index')->with('success', 'Data Pemeriksaan Konseling berhasil diperbarui.');
    }

    public function destroy(PemeriksaanKonseling $pemeriksaanKonseling)
    {
        $pemeriksaanKonseling->delete();

        return redirect()->route('pemeriksaan_konseling.index')->with('success', 'Data Pemeriksaan Konseling berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new PemeriksaanKonselingExport($search), 'data-pemeriksaan-konseling.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $items = PemeriksaanKonseling::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user'])
            ->when($search, function ($query, $search) {
                $query->whereHas('pemeriksaan.anak', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('pemeriksaan', function ($q) use ($search) {
                    $q->where('nomor_pemeriksaan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        $data = $items->map(function ($item) {
            return [
                'nomor_pemeriksaan' => $item->pemeriksaan->nomor_pemeriksaan ?? '-',
                'nama_anak' => $item->pemeriksaan->anak->nama ?? '-',
                'konseling' => $item->konseling,
                'pemberian_pmt' => $item->pemberian_pmt ? 'Ya' : 'Tidak',
            ];
        })->toArray();

        $pdf = Pdf::loadView('PemeriksaanKonseling.pdf', compact('data'));
        return $pdf->stream('data-pemeriksaan-konseling.pdf');
    }
}
