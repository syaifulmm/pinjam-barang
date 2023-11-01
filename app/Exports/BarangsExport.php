<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class BarangsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Barang::select('id_barang', 'nama_barang', 'kategori_id', 'satuan', 'jumlah','user_id')->get();
    }

    // public function view(): View
    // {
    //     return view('Barang.index', [
    //         'barangs' => Barang::all()
    //     ]);
    // }

    public function headings(): array
    {
        return ["ID Barang", "Nama Barang", "Kategori", "Satuan", "Jumlah", "PJ"];
    }

}
