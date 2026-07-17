<?php

namespace App\Http\Controllers;

use App\Exports\PemeriksaanMedisExport;
use App\Models\Imunisasi;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanMedis;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanMedisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pemeriksaanMedis = PemeriksaanMedis::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user', 'imunisasis'])
            ->when($search, function ($query, $search) {
                $query->whereHas('pemeriksaan.anak', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('pemeriksaan', function ($q) use ($search) {
                    $q->where('nomor_pemeriksaan', 'like', "%{$search}%");
                });
            })
            ->join('pemeriksaans', 'pemeriksaan_medis.pemeriksaan_id', '=', 'pemeriksaans.id')
            ->orderBy('pemeriksaans.tanggal_kunjungan', 'asc')
            ->orderBy('pemeriksaans.nomor_pemeriksaan', 'asc')
            ->select('pemeriksaan_medis.*')
            ->paginate(4)
            ->withQueryString();

        $pemeriksaans = Pemeriksaan::all();
        $users = User::all();
        $imunisasis = Imunisasi::all();

        return view('PemeriksaanMedis.index', compact('pemeriksaanMedis', 'pemeriksaans', 'users', 'imunisasis'));
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
            'pemberian_vitamin' => 'required|in:tidak,vitamin_a_merah,vitamin_a_biru',
            'pemberian_obat_cacing' => 'nullable|boolean',
            'status_rujukan_medis' => 'nullable|boolean',
            'catatan' => 'nullable|string',
            'imunisasi_id' => 'nullable|array',
            'imunisasi_id.*' => 'exists:imunisasis,id',
        ], [
            'pemeriksaan_id.required' => 'Pemeriksaan harus dipilih.',
            'pemeriksaan_id.exists' => 'Pemeriksaan yang dipilih tidak valid.',
            'pemberian_vitamin.required' => 'Pemberian vitamin harus dipilih.',
            'pemberian_vitamin.in' => 'Pilihan vitamin tidak valid.',
            'pemberian_obat_cacing.boolean' => 'Pemberian obat cacing tidak valid.',
            'status_rujukan_medis.boolean' => 'Status rujukan medis tidak valid.',
            'imunisasi_id.array' => 'Data imunisasi tidak valid.',
            'imunisasi_id.*.exists' => 'Jenis imunisasi yang dipilih tidak ada.',
        ]);

        $validated['pemberian_obat_cacing'] = $request->boolean('pemberian_obat_cacing');
        $validated['status_rujukan_medis'] = $request->boolean('status_rujukan_medis');

        $pemeriksaanMedis = PemeriksaanMedis::create($validated);

        if ($request->has('imunisasi_id')) {
            $pemeriksaanMedis = PemeriksaanMedis::find($validated['pemeriksaan_id']);
            $pemeriksaanMedis->imunisasis()->sync($request->imunisasi_id);
        }

        return redirect()->route('pemeriksaan_medis.index')->with('success', 'Data Pemeriksaan Medis berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pemeriksaanMedis = PemeriksaanMedis::findOrFail($id);
        //
    }

    public function edit($id)
    {
        $pemeriksaanMedis = PemeriksaanMedis::with(['pemeriksaan', 'user', 'imunisasis'])->findOrFail($id);
        return response()->json($pemeriksaanMedis);
    }

    public function update(Request $request, $id)
    {
        $pemeriksaanMedis = PemeriksaanMedis::findOrFail($id);

        $validated = $request->validate([
            'pemeriksaan_id' => 'required|exists:pemeriksaans,id',
            'user_id' => 'nullable|exists:users,id',
            'pemberian_vitamin' => 'required|in:tidak,vitamin_a_merah,vitamin_a_biru',
            'pemberian_obat_cacing' => 'nullable|boolean',
            'status_rujukan_medis' => 'nullable|boolean',
            'catatan' => 'nullable|string',
            'imunisasi_id' => 'nullable|array',
            'imunisasi_id.*' => 'exists:imunisasis,id',
        ], [
            'pemeriksaan_id.required' => 'Pemeriksaan harus dipilih.',
            'pemeriksaan_id.exists' => 'Pemeriksaan yang dipilih tidak valid.',
            'pemberian_vitamin.required' => 'Pemberian vitamin harus dipilih.',
            'pemberian_vitamin.in' => 'Pilihan vitamin tidak valid.',
            'pemberian_obat_cacing.boolean' => 'Pemberian obat cacing tidak valid.',
            'status_rujukan_medis.boolean' => 'Status rujukan medis tidak valid.',
            'imunisasi_id.array' => 'Data imunisasi tidak valid.',
            'imunisasi_id.*.exists' => 'Jenis imunisasi yang dipilih tidak ada.',
        ]);

        $validated['pemberian_obat_cacing'] = $request->boolean('pemberian_obat_cacing');
        $validated['status_rujukan_medis'] = $request->boolean('status_rujukan_medis');

        $pemeriksaanMedis->update($validated);

        if ($request->has('imunisasi_id')) {
            $pemeriksaanMedis->imunisasis()->sync($request->imunisasi_id);
        } else {
            $pemeriksaanMedis->imunisasis()->detach();
        }

        return redirect()->route('pemeriksaan_medis.index')->with('success', 'Data Pemeriksaan Medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemeriksaanMedis = PemeriksaanMedis::findOrFail($id);
        $pemeriksaanMedis->delete();

        return redirect()->route('pemeriksaan_medis.index')->with('success', 'Data Pemeriksaan Medis berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new PemeriksaanMedisExport($search), 'data-pemeriksaan-medis.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $items = PemeriksaanMedis::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user', 'imunisasis'])
            ->when($search, function ($query, $search) {
                $query->whereHas('pemeriksaan.anak', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('pemeriksaan', function ($q) use ($search) {
                    $q->where('nomor_pemeriksaan', 'like', "%{$search}%");
                });
            })
            ->join('pemeriksaans', 'pemeriksaan_medis.pemeriksaan_id', '=', 'pemeriksaans.id')
            ->orderBy('pemeriksaans.tanggal_kunjungan', 'asc')
            ->orderBy('pemeriksaans.nomor_pemeriksaan', 'asc')
            ->select('pemeriksaan_medis.*')
            ->get();

        $data = $items->map(function ($item) {
            return [
                'nomor_pemeriksaan' => $item->pemeriksaan->nomor_pemeriksaan ?? '-',
                'nama_anak' => $item->pemeriksaan->anak->nama ?? '-',
                'pemberian_vitamin' => ucwords(str_replace('_', ' ', $item->pemberian_vitamin)),
                'pemberian_obat_cacing' => $item->pemberian_obat_cacing ? 'Ya' : 'Tidak',
                'status_rujukan_medis' => $item->status_rujukan_medis ? 'Ya' : 'Tidak',
                'imunisasi' => $item->imunisasis->pluck('nama_imunisasi')->join(', ') ?: '-',
                'catatan' => $item->catatan ?? '-',
            ];
        })->toArray();

        $pdf = Pdf::loadView('PemeriksaanMedis.pdf', compact('data'));
        return $pdf->stream('data-pemeriksaan-medis.pdf');
    }
}
