@extends('adminlte::page')

@section('title', 'Master Kategori')

@section('content_header')
    <h1 class="m-0 text-dark">Data Kategori</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
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
                    <table class="table table-responsive table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th width='10%'>No.</th>
                            <th>Kategori</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kategories as $key => $kategori)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$kategori->nama_kategori }}</td>
                                <td>
                                    <a href="#" onclick="edit({{ $kategori->id }})" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{route('kategori.destroy', $kategori)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-sm">
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
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 id="judul">Tambah Kategori</h4>
                </div>
                <div style="display: " class="card-body" id="tambah">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        @if($errors->has('nama_kategori'))
                                <div class="alert alert-danger">
                                    {{-- <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> --}}
                                    {{ $errors->first('nama_kategori') }}
                                </div>
                        @endif
                        <div class="form-group">
                            <label for="">Nama Kategori</label>
                            <input type="text" name="nama_kategori"  class="form-control" placeholder="Nama Kategori" value="{{ old('nama_kategori') }}">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Tambah">
                            <input type="reset" class="btn btn-danger" value="Batal">
                        </div>
                    </form>
                </div>
                <div style="display: none" class="card-body" id="edit">
                    <form action="" method="POST" id="editform">
                        @csrf
                        @method('PUT')
                        @if($errors->has('nama_kategori'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>
                                            {{ $errors->first('nama_kategori') }}
                                        </li>
                                    </ul>
                                </div>
                        @endif
                        <div class="form-group">
                            <label for="">Nama Kategori</label>
                            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" placeholder="Nama Kategori">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Edit">
                            <input type="button" class="btn btn-danger" onclick="batal()" value="Batal">
                        </div>
                    </form>
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

    <script>
        function edit(a){
            document.getElementById("edit").style.display = "inline";
            document.getElementById("tambah").style.display = "none";
            $.get('kategori/' + a + '/edit', function(data) {
                var action = '{{route("kategori.update",  ":id"  )}}';
                action = action.replace(':id', data.id);
                $("#editform").attr("action", action);
                $('#nama_kategori').val(data.nama_kategori);
                document.getElementById("judul").innerHTML='Edit Kategori';
            });
        }
    </script>

    <script>
        function batal(){
            document.getElementById("edit").style.display = "none";
            document.getElementById("tambah").style.display = "inline";
            document.getElementById("judul").innerHTML='Tambah Kategori';
        }
    </script>
@endpush