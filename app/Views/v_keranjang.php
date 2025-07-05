<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php echo form_open('keranjang/edit') ?>
<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Foto</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $total_diskon_qty = 0;
        if (!empty($items)):
            foreach ($items as $index => $item):
                $qty = $item['qty'];
                $total_diskon_qty += $qty;
                ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><img src="<?= base_url("img/" . $item['options']['foto']) ?>" width="100px"></td>
                    <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                    <td>
                        <input type="number" min="1" name="qty<?= $i++ ?>" class="form-control"
                            value="<?= $qty ?>">
                    </td>
                    <td><?= number_to_currency($item['subtotal'], 'IDR') ?></td>
                    <td>
                        <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>
<!-- End Table with stripped rows -->

<?php
$diskon = session()->get('diskon_nominal') ?? 0;
$diskon_total = 0;
foreach ($items as $item) {
    $diskon_total += $diskon * $item['qty'];
}
$total_setelah_diskon = $total - $diskon_total;
?>

<div class="alert alert-info">
    <?= "Total: " . number_to_currency($total, 'IDR') ?><br>
    <?php if ($diskon > 0): ?>
        Diskon: <?= number_to_currency($diskon_total, 'IDR') ?> (<?= number_to_currency($diskon, 'IDR') ?> x total qty)<br>
        <strong>Total Setelah Diskon: <?= number_to_currency($total_setelah_diskon, 'IDR') ?></strong>
    <?php else: ?>
        <strong>Tidak ada diskon yang diterapkan.</strong>
    <?php endif; ?>
</div>

<button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
<a class="btn btn-warning" href="<?= base_url('keranjang/clear') ?>">Kosongkan Keranjang</a>
<?php if (!empty($items)): ?>
    <a class="btn btn-success" href="<?= base_url('checkout') ?>">Selesai Belanja</a>
<?php endif; ?>
<?php echo form_close() ?>

<?= $this->endSection() ?>
