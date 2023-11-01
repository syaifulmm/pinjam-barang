@if($data->status == 0)
    <div class="alert alert-danger">
        <h5 class="text-center">Peminjaman Anda Belum Disetujui Oleh Waka Sarana dan Prasarana</h5>    
    </div>
@elseif($data->status == 1)
    <div class="alert alert-warning">
        <h5 class="text-center">Peminjaman Anda Telah Disetujui, Silahkan Melakukan Pengambilan Barang pada PJ Barang yang Dipinjam</h5>    

    </div>
    <form action="">
        <div class="form-group">
            <label for="">Nama Peminjam</label>
            <input type="text" placeholder="Nama Peminjam" name="nama_peminjam" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="">Keperluan Peminjaman</label>
            <input type="text" placeholder="Keperluan Peminjaman" name="keperluan" class="form-control" id="">
        </div>
        
        <div class="form-group">
            <label for="">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control">
        </div>
    </form>
<table  class="table table-hover table-stripped" id="example2">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th style="width: 5rem">Qty</th>
            <th>PJ</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>1</td>
                <td>Kabel CCTV</td>
                <td>1</td>
                <td>Kabeng RPL</td>
                <td>Belum Diambil</td>
            </tr>
    </tbody>
</table>  
@else

@endif
