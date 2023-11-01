@extends('adminlte::page')

@section('title', 'Tambah Barang')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Barang</h1>
@stop

@section('content')
    <form action="{{route('barang.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputName">ID Barang</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="ID Barang" name="id_barang" value="{{$nomer ?? old('id_barang')}}" readonly>
                        @error('id_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Nama Barang</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Barang" name="nama_barang" value="{{old('nama_barang')}}">
                        @error('nama_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Kategori</label>
                        <select name="kategori_id" class="form-control form-select">
                            <option value="0">- Pilih Kategori -</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? "selected":"" }}>{{ $kat->nama_kategori }}</option>
                            @endforeach
                          </select>
                        @error('kategori_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Satuan</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Satuan" name="satuan" value="{{old('satuan')}}">
                        @error('satuan') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="exampleInputPassword" placeholder="Jumlah Barang" name="jumlah" value="{{old('jumlah')}}">
                        @error('jumlah') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    @if( Auth::user()->role == 1)
                    <div class="form-group">
                        <label for="exampleInputPassword">Penanggung Jawab</label>
                        <select name="user_id" class="form-control form-select">
                            <option value="0">- Pilih Penanggung Jawab -</option>
                            @foreach ($penjab as $pj)
                                <option value="{{ $pj->id }}" {{ old('user_id') == $pj->id ? "selected":"" }}>{{ $pj->name }}</option>
                             @endforeach
                          </select>
                        @error('user_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    @else
                    <div class="form-group">
                        <label for="exampleInputPassword">Penanggung Jawab</label>
                        <select name="user_id" class="form-control form-select" readonly>
                            <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->name }}</option>
                          </select>
                        @error('user_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div> 
                    @endif

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('barang.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop