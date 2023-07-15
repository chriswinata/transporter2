<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\kurir;
use App\Models\lokasi;
use App\Models\pengiriman;
use Exception;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_lokasi = lokasi::get();
        $all_barang = barang::get();
        $all_kurir = kurir::where('id', '!=', auth()->user()->id)->get();
        return view('pengiriman', compact('all_lokasi', 'all_barang', 'all_kurir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'no_pengiriman' => 'required|unique:pengiriman',
            'barang' => 'required',
            'lokasi' => 'required',
            'tanggal_pengiriman' => 'required'
        ]);

        try {
            pengiriman::create([
                'no_pengiriman' => $request->no_pengiriman,
                'tanggal' => $request->tanggal_pengiriman ?? null,
                'lokasi_id' => $request->lokasi,
                'barang_id' => $request->barang,
                'jumlah_barang' => $request->jumlah_barang ?? null,
                'kurir_id' => $request->kurir ?? null,
            ]);
        } catch(Exception $e){
            dd($e);
        }

        return view('dashboard');
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
    public function show(pengiriman $pengiriman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengiriman $pengiriman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengiriman $pengiriman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengiriman $pengiriman)
    {
        //
    }
}
