<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPeminjaman;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $peminjaman = Peminjaman::all();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function pengambilan()
    {
        // $peminjaman=Peminjaman::where('status', '=', 1)->with('detail')->get();
        // $peminjaman=Barang::where('user_id', '=', Auth::user()->id)->has('pinjam')->get();
        $peminjaman=DetailPeminjaman::with('barang', 'peminjaman')->get();
        $barang=$peminjaman->where('peminjaman.status', '=', 1)->where('barang.user_id', '=', Auth::user()->id);
        // return $barang;
        return view('peminjaman.ambil', compact('barang'));
    }

    public function bukti_ambil(Request $request , $id){


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
    public function show(string $id)
    {
        $pinjam=Peminjaman::find($id);
        // return $pinjam;
        return view ('peminjaman.detailpinjam', compact('pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function ambil(string $id)
    {
        $pinjam=DetailPeminjaman::where('barang_id', '=', $id)->get();
        // return $pinjam;
        return view ('peminjaman.detailambil', compact('pinjam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function accept($id){
        $pinjam = Peminjaman::find($id);
        $pinjam->status = 1;
        $pinjam->save();
        return redirect()->route('peminjaman.index')
            ->with('success_message', 'Peminjaman Disetujui');
    }

    public function deny($id){
        $pinjam = Peminjaman::find($id);
        $pinjam->status = 4;
        $pinjam->save();
        return redirect()->route('peminjaman.index')
            ->with('success_message', 'Peminjaman Ditolak');
    }
}
