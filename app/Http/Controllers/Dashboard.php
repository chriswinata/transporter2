<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\lokasi;
use App\Models\pengiriman;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index(){
        $all_lokasi = pengiriman::select('lokasi_id', DB::raw('count(lokasi_id) quantity'))->groupBy('lokasi_id')->get();
        // dd($all_lokasi);
        $top_lokasi = 0;
        $top_lokasi_id = null;
        foreach($all_lokasi as $lokasi){
            if($lokasi->quantity > $top_lokasi) {
                $top_lokasi = $lokasi->quantity;
                $top_lokasi_id = $lokasi->lokasi_id;
            }
        }
        $lokasi = lokasi::find($top_lokasi_id);

        $all_barang = pengiriman::select('barang_id', DB::raw('count(barang_id) quantity'))->groupBy('barang_id')->get();
        $top_barang = 0;
        $top_barang_id = null;
        foreach($all_barang as $barang) {
            if($barang->quantity > $top_barang) {
                $top_barang = $barang->quantity;
                $top_barang_id = $barang->barang_id;
            }
        }
        $barang = barang::find($top_barang_id);

        $total_pengiriman = pengiriman::count();

        $chart1 = pengiriman::pluck('jumlah_barang', 'lokasi_id');
        $labels = $chart1->keys();
        $data = $chart1->values();

        $chart2 = pengiriman::pluck('harga_barang', 'barang_id');
        $labels2 = $chart2->keys();
        $data2 = $chart2->values();

        return view('dashboard', compact('lokasi', 'total_pengiriman', 'barang', 'labels', 'data', 'labels2', 'data2'));
    }
}
