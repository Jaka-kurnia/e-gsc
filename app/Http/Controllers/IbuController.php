<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use Illuminate\Http\Request;

class IbuController extends Controller
{
    // Fungsi Index
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data['ibu'] = Ibu::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_ibu', 'like', "%{$search}%")
                        ->orWhere('nama_ayah', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('Ibu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // Fungsi Simpan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:ibus,nik',
            'nama_ibu' => 'required|string|max:100',
            'nama_ayah' => 'required|string|max:100',
            'no_hp' => 'required|string|max:14',
            'rt' => 'required|string|max:4',
            'rw' => 'required|string|max:4',
            'alamat' => 'required|string|max:255',
        ], [
            'nik.required' => 'NIK harus diisi tidak boleh kosong.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama_ibu.required' => 'Nama Ibu harus diisi tidak boleh kosong.',
            'nama_ayah.required' => 'Nama Ayah harus diisi tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP harus diisi tidak boleh kosong.',
            'rt.required' => 'RT harus diisi tidak boleh kosong.',
            'rw.required' => 'RW harus diisi tidak boleh kosong.',
            'alamat.required' => 'Alamat harus diisi tidak boleh kosong.',
        ]);

        Ibu::create($validated);

        return redirect()->route('ibu.index')->with('success', 'Data Orang Tua berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ibu $ibu)
    {
        //
    }

    //    Fungsi Edit
    public function edit(Ibu $ibu)
    {
        return response()->json($ibu);
    }

    // Fungsi Update
    public function update(Request $request, Ibu $ibu)
    {
        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:ibus,nik,' . $ibu->id,
            'nama_ibu' => 'required|string|max:100',
            'nama_ayah' => 'required|string|max:100',
            'no_hp' => 'required|string|max:14',
            'rt' => 'required|string|max:4',
            'rw' => 'required|string|max:4',
            'alamat' => 'required|string',
        ], [
            'nik.required' => 'NIK harus diisi tidak boleh kosong.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama_ibu.required' => 'Nama Ibu harus diisi tidak boleh kosong.',
            'nama_ayah.required' => 'Nama Ayah harus diisi tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP harus diisi tidak boleh kosong.',
            'rt.required' => 'RT harus diisi tidak boleh kosong.',
            'rw.required' => 'RW harus diisi tidak boleh kosong.',
            'alamat.required' => 'Alamat harus diisi tidak boleh kosong.',
        ]);

        $ibu->update($validated);

        return redirect()->route('ibu.index')->with('success', 'Data Orang Tua berhasil diperbarui.');
    }

    //    Fungsi Hapus
    public function destroy(Ibu $ibu)
    {
        $ibu->delete();
        return redirect()->route('ibu.index')->with('success', 'Data Orang Tua berhasil dihapus.');
    }
}
