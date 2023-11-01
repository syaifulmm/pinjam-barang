<?php

namespace App\Http\Controllers;

use App\Exports\BarangsExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Imports\BarangImport;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $penjab= User::where('role', '=', 3)->get();
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
        // return $penjab;
        return view('barang.create', compact('nomer', 'kategori', 'penjab'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_barang' => 'required',
			'nama_barang' => 'required',
            'kategori_id' => 'required',
            'satuan' => 'required',
            'jumlah' => 'required',
            'user_id' => 'required',
		]);
        $barang = Barang::create($request->all());
        return redirect()->route('barang.index')
            ->with('success_message', 'Berhasil menambah Barang baru');
    }


    public function import(Request $request)
    {
        
        $this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        $file = $request->file('file');
        $nama_file = rand().$file->getClientOriginalName();

        $file->move('import',$nama_file);

        Excel::import(new BarangImport, public_path('/import/'.$nama_file));

        return redirect()->route('barang.index')
            ->with('success_message', 'Berhasil menambah data');
    }

    public function export()
	{
		return Excel::download(new BarangsExport, 'Data barang - '.Carbon::now().'.xlsx');
	}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        $penjab= User::where('role', '=', 3)->get();
        if( $barang->user_id == Auth::user()->id){
            return view('barang.edit', compact('barang', 'kategori', 'penjab'));
        }else if(Auth::user()->role == 1 ){
            return view('barang.edit', compact('barang', 'kategori', 'penjab'));
        }else{
            return redirect()->route('barang.index')
            ->with('error_message', 'Anda bukan admin/pemilik barang ini');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'id_barang' => 'required',
			'nama_barang' => 'required',
            'kategori_id' => 'required',
            'satuan' => 'required',
            'jumlah' => 'required',
            'user_id' => 'required',
		]);
        $barang = Barang::find($id);
        $barang->update($request->all());
        return redirect()->route('barang.index')
            ->with('success_message', 'Berhasil menambah Barang baru');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::find($id);
        if( $barang->user_id == Auth::user()->id){
            $barang->delete();
            return redirect()->route('barang.index')
            ->with('success_message', 'Berhasil menghapus barang');
        }else if(Auth::user()->role == 1 ){
            $barang->delete();
            return redirect()->route('barang.index')
            ->with('success_message', 'Berhasil menghapus barang');
        }
        else{
            return redirect()->route('barang.index')
            ->with('error_message', 'Anda bukan admin/pemilik barang ini, tidak dapat menghapus.');
        }

    }

    public function kategori()
    {
        $kategories = Kategori::all();
        return view('kategori.index', compact('kategories'));
    }

    public function kategori_edit($id){
        $kat = kategori::find($id);
        return $kat;
    }

    public function kategori_update(Request $request , $id){
        $message = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter' 
        ];
        $this->validate($request,[
            'nama_kategori' => 'required|min:3|max:10'
        ], $message);
        $kat = Kategori::find($id);
        $kat->update($request->all());

        return redirect()->route('kategori.index')->with('success_message', 'Berhasil mengupdate kategori');
    }

    public function kategori_store(Request $request)
    {   
        $message = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter' 
        ];
        $this->validate($request,[
            'nama_kategori' => 'required|min:3|max:10'
        ], $message);
        kategori::create($request->all());
        return redirect()->route('kategori.index')
            ->with('success_message', 'Berhasil menambah kategori baru');
    }

    public function kategori_destroy(string $id)
    {
        $kategori = kategori::find($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success_message', 'Berhasil menghapus kategori');
    }

    

}
