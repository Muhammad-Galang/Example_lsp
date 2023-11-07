<?php if ($this->session->flashdata('success_message')) { ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success_message') ?>
    </div>
<?php } elseif ($this->session->flashdata('error_message')) { ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error_message') ?>
    </div>
<?php } ?>
<h1>TAMBAH PEMBELIAN BARANG</h1>
<form class="form-inline" action="<?= site_url('beli/tambah_pembelian') ?>" method="post">
    <div class="form-group mx-sm-5 mb-2">
        <label>KODE_BARANG</label>
        <select class="form-control" name="kodebrg" <?= set_value('kodebrg') ?>>
            <option>PILIH KODE_BARANG</option>
            <?php foreach ($get_nama_beli as $row) { ?>
                <option value="<?= $row->kode_brg ?>"><?= $row->nama ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group mx-sm-5 mb-2"> <label>JUMLAH</label>
        <input type="number" name="qty" class="form-control" id="formGroupExampleInput2" placeholder="SATUAN">
    </div>

    <button type="submit" class="btn btn-primary mb-2">SUBMIT</button>
</form>

<h1>Daftar Pembelian</h1>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No.Nota</th>
            <th scope="col">Tanggal Pembelian</th>
            <th scope="col">Kode Barang</th>
            <th scope="col">qty</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($GetAllData as $item) : ?>
            <tr>
                <td><?= $item->nofaktur ?></td>
                <td><?= $item->tgl ?></td>
                <td><?= $item->kode_brg ?></td>
                <td><?= $item->qty ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>