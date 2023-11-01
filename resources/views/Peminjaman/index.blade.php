@extends('adminlte::page')

@section('title', 'Master Barang')

@section('content_header')
    <h1 class="m-0 text-dark">Data Peminjaman</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped dataTable no-footer "  id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Peminjaman</th>
                            <th>Nama Peminjam</th>
                            {{-- <th>Keperluan</th> --}}
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($peminjaman as $key => $pinjam)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$pinjam->kode_peminjaman}}</td>
                                <td>{{$pinjam->nama_peminjam}}</td>
                                {{-- <td>{{$pinjam->keperluan}}</td> --}}
                                <td>{{$pinjam->tanggal_pinjam}}</td>
                                <td>{{$pinjam->tanggal_kembali}}</td>
                                <td>@if($pinjam->status == 0) <a class="btn btn-sm btn-secondary">Belum Disetujui</a> 
                                    @elseif($pinjam->status == 1) <a class="btn btn-sm btn-info">Disetujui</a>
                                    @elseif($pinjam->status == 2) <a class="btn btn-sm btn-warning">Belum Kembali</a>
                                    @elseif($pinjam->status == 3) <a class="btn btn-sm btn-success">Dikembalikan</a>
                                    @else  <a class="btn btn-sm btn-danger">Ditolak</a>
                                    @endif
                                </td>
                                <td>
                                    @if($pinjam->status == 0)
                                        <a onclick="show({{ $pinjam->id }})"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i></a>
                                        <a href="{{ route('peminjaman.accept', $pinjam->id) }}" onclick="notificationBeforeAccept(event, this)" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        <a href="{{ route('peminjaman.deny', $pinjam->id) }}" onclick="notificationBeforeDeny(event, this)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    @elseif($pinjam->status == 4)
                                        <a onclick=""  class="btn btn-secondary btn-sm"><i class="fa fa-list"></i></a>
                                    @else
                                        <a onclick="show({{ $pinjam->id }})"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i></a>
                                        {{-- <a href="" onclick="notificationBeforeDelete(event, this)" class="btn btn-success btn-sm">Pengambilan Barang</a> --}}
                                    @endif
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
                   <h4 class="text-dark" id="judul">Detail Peminjaman</h4>
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
            $.get('peminjaman/'+id , function(data){
                $('#detail').html(data);
            })
        }
    </script>

    <form action="" id="deny-form" method="post">
        @method('put')
        @csrf
    </form>

    <form action="" id="accept-form" method="post">
        @method('put')
        @csrf
    </form>

    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDeny(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menolak peminjaman ini ? ')) {
                $("#deny-form").attr('action', $(el).attr('href'));
                $("#deny-form").submit();
            }
        }

        function notificationBeforeAccept(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menyetujui peminjaman ini ? ')) {
                $("#accept-form").attr('action', $(el).attr('href'));
                $("#accept-form").submit();
            }
        }

    </script>
@endpush