@extends('adminlte::page')

@section('title', 'Master Barang')

@section('content_header')
    <h1 class="m-0 text-dark">Data Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="btn-group">
                        <a href="{{route('barang.create')}}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>  Tambah Barang</a>
                        <button type="button" class="btn btn-primary mb-2 dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            <a href="" class="btn dropdown-item" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-upload"></i> Import Excel
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('barang-download') }}" target="_blank" class="btn btn-success mb-2">
                        <i class="fas fa-download"></i> Export Excel
                    </a>

                    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Import dari Excel</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('barang-upload') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file" required>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>JUMLAH</th>
                            <th>PJ</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($barangs as $key => $barang)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$barang->id_barang}}</td>
                                <td>{{$barang->nama_barang}}</td>
                                <td>{{$barang->kategori->nama_kategori}}</td>                                
                                <td>{{$barang->satuan}}</td>                                
                                <td>{{$barang->jumlah}}</td>
                                <td>{{$barang->user->name}}</td>
                                <td>
                                    <a href="{{route('barang.edit', $barang)}}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{route('barang.destroy', $barang)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                </td>                                                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush