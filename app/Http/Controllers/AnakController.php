<?php

namespace App\Http\Controllers;

use App\Exports\AnakExport;
use App\Models\Anak;
use App\Models\Ibu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $anak = Anak::with('ibu')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->paginate(4)
            ->withQueryString();

        $ibu = Ibu::all();
        return view('Anak.index', compact('anak', 'ibu'));
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
            'ibu_id' => 'required',
            'nik' => 'required|string|max:16|unique:anaks,nik',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
        ], [
            'ibu_id.required' => 'Orang Tua harus dipilih.',
            'ibu_id.exists' => 'Orang Tua yang dipilih tidak valid.',
            'nik.required' => 'NIK harus diisi tidak boleh kosong.',
            'nik.string' => 'NIK harus berupa string.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama Anak harus diisi tidak boleh kosong.',
            'nama.string' => 'Nama Anak harus berupa string.',
            'nama.max' => 'Nama Anak tidak boleh lebih dari 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal Lahir harus diisi tidak boleh kosong.',
            'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal yang valid.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis Kelamin yang dipilih tidak valid.',
            'berat_badan.numeric' => 'Berat Badan harus berupa angka.',
            'tinggi_badan.numeric' => 'Tinggi Badan harus berupa angka.',
        ]);

        Anak::create($validated);

        return redirect()->route('anak.index')->with('success', 'Data Anak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anak $anak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anak $anak)
    {
        return response()->json($anak);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anak $anak)
    {
        $validated = $request->validate([
            'ibu_id' => 'required',
            'nik' => 'required|string|max:16|unique:anaks,nik,' . $anak->id,
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
        ], [
            'ibu_id.required' => 'Orang Tua harus dipilih.',
            'ibu_id.exists' => 'Orang Tua yang dipilih tidak valid.',
            'nik.required' => 'NIK harus diisi tidak boleh kosong.',
            'nik.string' => 'NIK harus berupa string.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama Anak harus diisi tidak boleh kosong.',
            'nama.string' => 'Nama Anak harus berupa string.',
            'nama.max' => 'Nama Anak tidak boleh lebih dari 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal Lahir harus diisi tidak boleh kosong.',
            'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal yang valid.',
            'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis Kelamin yang dipilih tidak valid.',
            'berat_badan.numeric' => 'Berat Badan harus berupa angka.',
            'tinggi_badan.numeric' => 'Tinggi Badan harus berupa angka.',
        ]);

        $anak->update($validated);

        return redirect()->route('anak.index')->with('success', 'Data Anak berhasil diperbarui.');
    }

    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new AnakExport($search), 'data-anak.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $items = Anak::with('ibu')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        $data = $items->map(function ($item) {
            return [
                'nik' => $item->nik,
                'nama' => $item->nama,
                'nama_orang_tua' => $item->ibu->nama_ibu ?? '-',
                'tanggal_lahir' => $item->tanggal_lahir,
                'jenis_kelamin' => $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                'berat_badan' => $item->berat_badan ? $item->berat_badan . ' kg' : '-',
                'tinggi_badan' => $item->tinggi_badan ? $item->tinggi_badan . ' cm' : '-',
            ];
        })->toArray();

        $pdf = Pdf::loadView('Anak.pdf', compact('data'));
        return $pdf->stream('data-anak.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $anak)
    {
        try {
            $anak->delete();

            return redirect()->back()->with('success', 'Data anak berhasil dihapus!');
        } catch (QueryException $e) {
            // cek error foregin key
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Data anak tidak bisa dihapus karena masih memiliki riwayat pemeriksaan aktif.');
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
