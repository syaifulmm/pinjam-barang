@extends('adminlte::master')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<style>
    section{
                padding-top: 5rem;
            }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">SIMPINJAM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                {{-- <a class="nav-link active" href="#home">Home</a> --}}
                <a class="nav-link active" href="#form-pinjam">Form Pinjam</a>
                <a class="nav-link active" href="#cek-status">Cek Status</a>
            </div>
        </div>
    </div>
</nav>

<section id="form-pinjam">
    <div class="container" style="min-height: 90%">
        <div class="row">
            <h4 class="masthead-heading text-center mb-0" style="padding-bottom: 2rem">Form Peminjaman Barang</h4>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h6>Data Barang</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->kategori->nama_kategori }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td><a href="{{ route('cart.add', $item->id) }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h6>Data Peminjaman</h6>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div> 
                    @endif
                    <div class="card-body">
                        <table  class="table table-hover table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th style="width: 5rem">Qty</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if(session('cart'))
                                    @foreach(session('cart') as $id => $item)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $item['name'] }}</td>
                                                <td><{{ $item['quantity'] }}/td>
                                                <td><a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
                                            </tr>
                                    @endforeach
                               @endif --}}
                            </tbody>
                        </table>
                        <br>
                        <form action="">
                            <div class="form-group">
                                <label for="nama_peminjam">Nama Peminjam</label>
                                <input type="text" placeholder="Nama Peminjam" name="nama_peminjam" class="form-control" id="nama_peminjam">
                            </div>
                            <div class="form-group">
                                <label for="keperluan">Keperluan Peminjaman</label>
                                <input type="text" placeholder="Keperluan Peminjaman" name="keperluan" class="form-control" id="keperluan">
                            </div>
                            
                            <div class="form-group">
                                <label>Tanggal Pinjam & Kembali</label>
                                <div class="input-group" id="tanggal">
                                    <input type="date" name="tanggal_pinjam" class="form-control">
                                    <input type="date" name="tanggal_kembali" class="form-control">
                                </div>
                            </div>

                            <div class="form-group jtext-end">
                                <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
                                <button type="reset" class="btn btn-danger">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cek-status">
    <div class="container pt-5 pb-5" style="min-height: 90%" >
        <div class="row">
            <h4 class="masthead-heading text-center mb-0" style="padding-bottom: 2rem">Cek Status Peminjaman</h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">
                        <form class="" action="">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Masukkan Kode Peminjaman anda">
                                <button type="submit" class="btn btn-success">Cari</button>
                           </div>
                        </form>
                        <div id="cek-status">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@push('js')
<script>
    $('#example2').DataTable({
        "responsive": true,
    });
</script>
@endpush