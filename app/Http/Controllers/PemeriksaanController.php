<?php

namespace App\Http\Controllers;

use App\Exports\PemeriksaanExport;
use App\Models\Anak;
use App\Models\Jadwal;
use App\Models\Pemeriksaan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data['pemeriksaan'] = Pemeriksaan::with(['jadwal', 'anak', 'user', 'approvedBy'])
            ->when($search, function ($query, $search) {
                $query->whereHas('anak', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('nomor_antri', 'like', "%{$search}%");
            })
            ->paginate(4)
            ->withQueryString();

        $data['anak'] = Anak::all();
        $data['jadwal'] = Jadwal::all();
        $data['users'] = User::all();

        $today = now()->format('Ymd');

        $lastToday = Pemeriksaan::where('nomor_pemeriksaan', 'like', 'PRK-' . $today . '-%')->latest('id')->first();
        $nextNum = $lastToday ? ((int) substr($lastToday->nomor_pemeriksaan, -4)) + 1 : 1;
        $data['nextNomorPemeriksaan'] = 'PRK-' . $today . '-' . str_pad($nextNum, 4, '0', STR_PAD_LEFT);

        $lastTodayAntri = Pemeriksaan::whereDate('tanggal_kunjungan', today())->latest('id')->first();
        $nextAntri = $lastTodayAntri ? ((int) $lastTodayAntri->nomor_antri) + 1 : 1;
        $data['nextNomorAntri'] = str_pad($nextAntri, 4, '0', STR_PAD_LEFT);

        return view('Pemeriksaan.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'anak_id' => 'required',
            'jadwal_id' => 'required',
            'approved_by' => 'nullable',
            'tanggal_kunjungan' => 'required',
            'metode_kunjungan' => 'required',
            'umur_bulan' => 'required',
            'approvel_status' => 'required',
        ], []);

        $today = now()->format('Ymd');

        $lastToday = Pemeriksaan::where('nomor_pemeriksaan', 'like', 'PRK-' . $today . '-%')->latest('id')->first();
        $nextNum = $lastToday ? ((int) substr($lastToday->nomor_pemeriksaan, -4)) + 1 : 1;
        $validated['nomor_pemeriksaan'] = 'PRK-' . $today . '-' . str_pad($nextNum, 4, '0', STR_PAD_LEFT);

        $lastTodayAntri = Pemeriksaan::whereDate('tanggal_kunjungan', today())->latest('id')->first();
        $nextAntri = $lastTodayAntri ? ((int) $lastTodayAntri->nomor_antri) + 1 : 1;
        $validated['nomor_antri'] = str_pad($nextAntri, 4, '0', STR_PAD_LEFT);

        Pemeriksaan::create($validated);
        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan Berhasil Ditambahkan');
    }

    public function show(Pemeriksaan $pemeriksaan)
    {
        //
    }

    public function edit(Pemeriksaan $pemeriksaan)
    {
        return response()->json($pemeriksaan);
    }

    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'anak_id' => 'required',
            'jadwal_id' => 'required',
            'approved_by' => 'nullable',
            'tanggal_kunjungan' => 'required',
            'metode_kunjungan' => 'required',
            'umur_bulan' => 'required',
            'approvel_status' => 'required',
        ], []);

        $pemeriksaan->update($validated);
        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan Berhasil Diubah');
    }

    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();
        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan Berhasil Dihapus');
    }

    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new PemeriksaanExport($search), 'data-pemeriksaan.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $items = Pemeriksaan::with(['jadwal', 'anak', 'user', 'approvedBy'])
            ->when($search, function ($query, $search) {
                $query->whereHas('anak', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('nomor_antri', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        $data = $items->map(function ($item) {
            return [
                'nomor_pemeriksaan' => $item->nomor_pemeriksaan,
                'nomor_antri' => $item->nomor_antri,
                'nama_anak' => $item->anak->nama ?? '-',
                'nama_kegiatan' => $item->jadwal->nama_kegiatan ?? '-',
                'metode_kunjungan' => $item->metode_kunjungan == 'hari_h' ? 'Hari H' : 'Sweeping',
                'tanggal_kunjungan' => $item->tanggal_kunjungan,
                'umur_bulan' => $item->umur_bulan . ' Bulan',
                'approvel_status' => ucfirst($item->approvel_status),
            ];
        })->toArray();

        $pdf = Pdf::loadView('Pemeriksaan.pdf', compact('data'));
        return $pdf->stream('data-pemeriksaan.pdf');
    }
}
