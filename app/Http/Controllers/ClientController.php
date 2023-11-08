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

        if(isset($cart[$id])){
            $cart[$id]['qty'] += 1;
        }else{
            // return $cart;
            $cart[$id] = [
                "id"   => $barang->id,
                "name" => $barang->nama_barang,
                "qty"  => 1
            ];
        }

        session()->put('cart', $cart);    
        // return session()->get('cart');
        return redirect()->back();
    }

    public function delete(Request $request, $id){
        // $request->session()->flush();
        $cart = session()->get('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);    
        }
        return redirect()->back();
    }

    public function update(Request $request){
        $quantities = $request->input('qty');
        $id = $request->input('id');
        $cart = session()->get('cart');
        // return $id;
        // return $quantities;
        for ($i =0 ; $i < count($cart) ; $i++){
            // $a = 1;
            $cart[$id[$i]]['qty'] = $quantities[$i];
            // $a+=1;
        }
        session()->put('cart', $cart);    
        return redirect()->back();
    }


    

}
