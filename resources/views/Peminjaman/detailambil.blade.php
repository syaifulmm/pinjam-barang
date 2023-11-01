<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    @foreach ($pinjam as $item)
        <div class="form-group">
            <label for="exampleInputName">Nama Barang</label>
            <input type="text" class="form-control" id="exampleInputName" value="{{ $item->barang->nama_barang }}" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputName">Jumlah</label>
            <input type="text" class="form-control" id="exampleInputName" value="{{ $item->jumlah }}" readonly>
        </div>
        @if($item->bukti_ambil == null)
            <form action="{{ route('ambil.bukti', $item->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="exampleInputName">Tanggal Pengambilan</label>
                    <input type="date" class="form-control" name="tanggal_ambil" id="exampleInputName" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Bukti Pengambilan</label>
                    <input type="file" class="form-control" name="bukti_ambil" id="exampleInputName" value="">
                </div>
                <input class="btn btn-success" type="submit" value="Simpan">
                <input class="btn btn-danger" type="button" value="Batal">
            </form>
        @else
            <div class="form-group">
                <label for="exampleInputName">Tanggal Pengambilan</label>
                <input type="date" class="form-control" id="exampleInputName" value="{{ $item->tanggal_ambil }}">
            </div>
            <div class="form-group">
                <label for="exampleInputName">Bukti Pengambilan</label>
                <input type="text" class="form-control" id="exampleInputName" value="{{ $item->bukti_ambil }}">
            </div>  
        @endif
    @endforeach
    
</form>