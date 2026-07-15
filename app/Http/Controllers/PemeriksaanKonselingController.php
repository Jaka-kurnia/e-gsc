<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanKonseling;
use Illuminate\Http\Request;

class PemeriksaanKonselingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('PemeriksaanKonseling.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PemeriksaanKonseling $pemeriksaanKonseling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PemeriksaanKonseling $pemeriksaanKonseling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PemeriksaanKonseling $pemeriksaanKonseling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PemeriksaanKonseling $pemeriksaanKonseling)
    {
        //
    }
}
