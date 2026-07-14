<?php

namespace App\Http\Controllers;

use App\Exports\PemeriksaanAntropometriExport;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanAntropometri;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanAntropometriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pemeriksaanAntropometri = PemeriksaanAntropometri::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user'])
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

        return view('PemeriksaanAntropometri.index', compact('pemeriksaanAntropometri', 'pemeriksaans', 'users'));
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
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'tren_pertumbuhan' => 'required|in:N,T,BGM,-',
            'status_gizi' => 'required|in:normal,gizi_kurang,gizi_buruk,gizi_lebih',
        ], [
            'pemeriksaan_id.required' => 'Pemeriksaan harus dipilih.',
            'pemeriksaan_id.exists' => 'Pemeriksaan yang dipilih tidak valid.',
            'berat_badan.required' => 'Berat Badan harus diisi.',
            'berat_badan.numeric' => 'Berat Badan harus berupa angka.',
            'tinggi_badan.required' => 'Tinggi Badan harus diisi.',
            'tinggi_badan.numeric' => 'Tinggi Badan harus berupa angka.',
            'lingkar_kepala.numeric' => 'Lingkar Kepala harus berupa angka.',
            'tren_pertumbuhan.required' => 'Tren Pertumbuhan harus dipilih.',
            'tren_pertumbuhan.in' => 'Tren Pertumbuhan yang dipilih tidak valid.',
            'status_gizi.required' => 'Status Gizi harus dipilih.',
            'status_gizi.in' => 'Status Gizi yang dipilih tidak valid.',
        ]);

        PemeriksaanAntropometri::create($validated);

        return redirect()->route('pemeriksaan_antropometri.index')->with('success', 'Data Pemeriksaan Antropometri berhasil ditambahkan.');
    }

    public function show(PemeriksaanAntropometri $pemeriksaanAntropometri)
    {
        //
    }

    public function edit(PemeriksaanAntropometri $pemeriksaanAntropometri)
    {
        $pemeriksaanAntropometri->load(['pemeriksaan', 'user']);
        return response()->json($pemeriksaanAntropometri);
    }

    public function update(Request $request, PemeriksaanAntropometri $pemeriksaanAntropometri)
    {
        $validated = $request->validate([
            'pemeriksaan_id' => 'required|exists:pemeriksaans,id',
            'user_id' => 'nullable|exists:users,id',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'tren_pertumbuhan' => 'required|in:N,T,BGM,-',
            'status_gizi' => 'required|in:normal,gizi_kurang,gizi_buruk,gizi_lebih',
        ], [
            'pemeriksaan_id.required' => 'Pemeriksaan harus dipilih.',
            'pemeriksaan_id.exists' => 'Pemeriksaan yang dipilih tidak valid.',
            'berat_badan.required' => 'Berat Badan harus diisi.',
            'berat_badan.numeric' => 'Berat Badan harus berupa angka.',
            'tinggi_badan.required' => 'Tinggi Badan harus diisi.',
            'tinggi_badan.numeric' => 'Tinggi Badan harus berupa angka.',
            'lingkar_kepala.numeric' => 'Lingkar Kepala harus berupa angka.',
            'tren_pertumbuhan.required' => 'Tren Pertumbuhan harus dipilih.',
            'tren_pertumbuhan.in' => 'Tren Pertumbuhan yang dipilih tidak valid.',
            'status_gizi.required' => 'Status Gizi harus dipilih.',
            'status_gizi.in' => 'Status Gizi yang dipilih tidak valid.',
        ]);

        $pemeriksaanAntropometri->update($validated);

        return redirect()->route('pemeriksaan_antropometri.index')->with('success', 'Data Pemeriksaan Antropometri berhasil diperbarui.');
    }

    public function destroy(PemeriksaanAntropometri $pemeriksaanAntropometri)
    {
        $pemeriksaanAntropometri->delete();

        return redirect()->route('pemeriksaan_antropometri.index')->with('success', 'Data Pemeriksaan Antropometri berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new PemeriksaanAntropometriExport($search), 'data-pemeriksaan-antropometri.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $items = PemeriksaanAntropometri::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user'])
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
                'berat_badan' => $item->berat_badan . ' kg',
                'tinggi_badan' => $item->tinggi_badan . ' cm',
                'lingkar_kepala' => $item->lingkar_kepala ? $item->lingkar_kepala . ' cm' : '-',
                'tren_pertumbuhan' => $item->tren_pertumbuhan,
                'status_gizi' => ucwords(str_replace('_', ' ', $item->status_gizi)),
            ];
        })->toArray();

        $pdf = Pdf::loadView('PemeriksaanAntropometri.pdf', compact('data'));
        return $pdf->stream('data-pemeriksaan-antropometri.pdf');
    }
}
