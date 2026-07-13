<?php

namespace App\Http\Controllers;

use App\Exports\ImunisasiExport;
use App\Models\Imunisasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data['imunisasi'] = Imunisasi::query()
            ->when($search, function ($query, $search) {
                $query->where('kode_imunisasi', 'like', "%{$search}%")
                    ->orWhere('nama_imunisasi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(4)
            ->withQueryString();
        return view('Imunisasi.index', $data);
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
        $validate = $request->validate([
            'kode_imunisasi' => 'required|string|max:10|unique:imunisasis,kode_imunisasi',
            'nama_imunisasi' => 'required|string',
            'deskripsi' => 'nullable',
        ], [
            'kode_imunisasi.required' => 'Kode Imunisasi harus diisi tidak boleh kosong.',
            'kode_imunisasi.string' => 'Kode Imunisasi harus berupa Huruf.',
            'kode_imunisasi.max' => 'Kode Imunisasi maksimal 10 karakter.',
            'kode_imunisasi.unique' => 'Kode Imunisasi sudah terdaftar.',
            'nama_imunisasi.required' => 'Nama Imunisasi harus diisi tidak boleh kosong.',
            'nama_imunisasi.string' => 'Nama Imunisasi harus berupa Huruf.',
            'deskripsi.string' => 'Deskripsi harus berupa Huruf.',

        ]);
        Imunisasi::create($validate);

        return redirect()->route('imunisasi.index')->with('success', 'Data Imunisasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Imunisasi $imunisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imunisasi $imunisasi)
    {
        return response()->json($imunisasi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imunisasi $imunisasi)
    {
        $validate = $request->validate([
            'kode_imunisasi' => 'required|string|max:10|unique:imunisasis,kode_imunisasi,' . $imunisasi->id,
            'nama_imunisasi' => 'required|string',
            'deskripsi' => 'nullable',
        ], [
            'kode_imunisasi.required' => 'Kode Imunisasi harus diisi tidak boleh kosong.',
            'kode_imunisasi.string' => 'Kode Imunisasi harus berupa Huruf.',
            'kode_imunisasi.max' => 'Kode Imunisasi maksimal 10 karakter.',
            'kode_imunisasi.unique' => 'Kode Imunisasi sudah terdaftar.',
            'nama_imunisasi.required' => 'Nama Imunisasi harus diisi tidak boleh kosong.',
            'nama_imunisasi.string' => 'Nama Imunisasi harus berupa Huruf.',
            'deskripsi.string' => 'Deskripsi harus berupa Huruf.',

        ]);
        $imunisasi->update($validate);

        return redirect()->route('imunisasi.index')->with('success', 'Data Imunisasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new ImunisasiExport($search), 'data-imunisasi.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $data = Imunisasi::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_imunisasi', 'like', "%{$search}%")
                    ->orWhere('kode_imunisasi', 'like', "%{$search}%");
            })
            ->latest()
            ->get()
            ->toArray();

        $pdf = Pdf::loadView('Imunisasi.pdf', compact('data'));
        return $pdf->stream('data-imunisasi.pdf');
    }

    public function destroy(Imunisasi $imunisasi)
    {
        $imunisasi->delete();
        return redirect()->route('imunisasi.index')->with('success', 'Data Imunisasi berhasil dihapus.');
    }
}
