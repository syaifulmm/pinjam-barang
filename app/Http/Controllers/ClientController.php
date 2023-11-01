<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function index(Request $request){
        $data = Barang::all();
        return view('client', compact('data'));
    }

    public function status(){
        $data = Peminjaman::find(1);
        // return $data;
        return view('status', compact('data'));
    }

    public function add(Request $request, $id){
       $barang = barang::findorfail($id);
        // return $barang;
        $cart = session()->get('cart');
        // return $cart;
        $cart[$id] = [
            "name" => $barang->nama_barang,
            "qty"  => 1
        ];

        session()->put('cart', $cart);

        return session()->get('cart');

        
    }

   
    

}
