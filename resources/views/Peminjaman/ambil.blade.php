@extends('adminlte::page')

@section('title', 'Master Barang')

@section('content_header')
    <h1 class="m-0 text-dark">Pengambilan Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped dataTable no-footer" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Peminjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($barang as $pinjam)
                            {{-- {{ dd($pinjam) }} --}}
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$pinjam->peminjaman->kode_peminjaman}}</td>
                                <td>{{$pinjam->peminjaman->nama_peminjam}}</td>
                                <td>{{$pinjam->barang->nama_barang}}</td>
                                <td>{{$pinjam->peminjaman->tanggal_pinjam}}</td>
                                <td>{{$pinjam->peminjaman->tanggal_kembali}}</td>
                                <td>@if($pinjam->peminjaman->status == 0) <a class="btn btn-sm btn-secondary">Belum Disetujui</a> 
                                    @elseif($pinjam->peminjaman->status == 1) <a class="btn btn-sm btn-info">Disetujui</a>
                                    @elseif($pinjam->peminjaman->status == 2) <a class="btn btn-sm btn-warning">Belum Kembali</a>
                                    @else <a class="btn btn-sm btn-success">Dikembalikan</a> 
                                    @endif
                                </td>
                                <td>
                                    <a onclick="show({{ $pinjam->barang_id }})" class="btn btn-success btn-sm">Pengambilan</a>
                                </td>                                                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   <h4 class="text-dark">Data Pengambilan</h4>
                </div>
                <div class="card-body" id="detail">
                    <h6 class="text-center"> Pilih Data Peminjaman</h6> 
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        function show(id){
            $.get('pengambilan/'+id , function(data){
                $('#detail').html(data);
            })
        }
    </script>

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