<h1>Tambah penjualan</h1>
<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success_message') ?>
    </div>
<?php endif; ?>

<!-- Tampilkan pesan kesalahan jika ada -->
<?php if ($this->session->flashdata('error_message')) : ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error_message') ?>
    </div>
<?php endif; ?>
<form class="form-inline" action="<?= site_url('jual/add_sale') ?>" method="post">
    <div class="form-group mx-sm-5 mb-2">
        <label>NOFAKTUR</label>
        <input type="text" name="nofaktur" class="form-control" id="formGroupExampleInput" value="<?php echo sprintf($get_jual) ?>" readonly>
    </div>
    <div class="form-group mx-sm-5 mb-2">
        <label>TGL</label>
        <input type="date" name="tgl" class="form-control" id="formGroupExampleInput" value="<?= date('Y-m-d'); ?>" readonly>
    </div>
    <div class="form-group mx-sm-5 mb-2">
        <label>KODE_BARANG</label>
        <select class="form-control" name="kodebrg" <?= set_value('kode_brg') ?>>
            <option>PILIH KODE_BARANG</option>
            <?php foreach ($get_nama_brg as $row) { ?>
                <option value="<?= $row->kode_brg ?>"><?= $row->nama ?></option>
            <?php } ?>
        </select>
        <?php if (isset($stok_habis) && $stok_habis) { ?>
            <p style="color: red;">Stok barang habis.</p>
        <?php } ?>
        <br>
    </div>
    <div class="form-group mx-sm-5 mb-2">
        <label>JUMLAH</label>
        <input type="number" name="qty" class="form-control" id="formGroupExampleInput2" placeholder="JUMLAH">
    </div>

    <button type="submit" class="btn btn-primary mb-2">SUBMIT</button>
</form>

<h1>Daftar Penjualan Hari ini</h1>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No.Nota</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Kode Barang</th>
            <th scope="col">Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($penjualan as $item) : ?>
            <tr>
                <td><?= $item->nofaktur ?></td>
                <td><?= $item->tgl ?></td>
                <td><?= $item->kode_brg ?></td>
                <td><?= $item->qty ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


