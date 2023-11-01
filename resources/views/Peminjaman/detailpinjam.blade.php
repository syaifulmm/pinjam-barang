<div class="form-group">
    <label for="Keperluan Pinjam">Kode Peminjaman :</label>
    <h4>{{ $pinjam->kode_peminjaman }}</h4>
    {{-- <input class="form-control" type="text" value="{{ $pinjam->kode_peminjaman }}" disabled> --}}
</div>
<div class="form-group">
    <label for="Keperluan Peminjaman">Keperluan Peminjaman :</label>
    {{-- <textarea class="form-control" name="Keperluan" id="" readonly>{{ $pinjam->keperluan }}</textarea> --}}
    <h6>{{ $pinjam->keperluan }}</h6>
</div>
<table class="table">
    <thead>
        <th>#</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
    </thead>
     @foreach ($pinjam->detail as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->barang->id_barang }}</td>
        <td>{{ $item->barang->nama_barang }}</td>
        <td>{{ $item->jumlah }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Tanggal Ambil :</td>
        <td style="justify-content: center" colspan="2">{{ $item->tanggal_ambil ?: 'Belum Diambil' }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Bukti Ambil :</td>
        <td style="justify-content: center" colspan="2">{{ $item->bukti_ambil ?: 'Belum Diambil' }}</td>
    </tr>
    @endforeach
    
</table>
