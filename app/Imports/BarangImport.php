<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $kategoris;
    public function __construct()
    {
        $this->kategoris = Kategori::select('id', 'nama_kategori')->get();
    }

    public function model(array $row)
    {
        $now = Carbon::now();
        $thnbulan = $now->year . $now->month;
        $cek = Barang::count();
        if($cek == 0){
            $urut = 10000001;
            $nomer = 'BRG'.$thnbulan.$urut; 
        }else{
            $ambil= Barang::all()->last();
            $urut = (int)substr($ambil->id_barang, -8) + 1;
            $nomer = 'BRG'.$thnbulan.$urut; 
        }

        $kategori = $this->kategoris->where('nama_kategori', $row['kategori'])->first();
        return new Barang([
            'id_barang' => $nomer,
            'kategori_id' => $kategori->id ?? NULL,
            'user_id' => Auth::user()->id,
            'nama_barang' => $row['nama_barang'],
            'satuan' => $row['satuan'],
            'jumlah' => $row['jumlah']
        ]);
    }
}
