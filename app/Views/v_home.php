<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php if (!empty($diskon)) : ?>
    <div class="alert alert-success">
        <strong>Diskon Hari Ini!</strong><br>
        Dapatkan diskon sebesar <?= number_to_currency($diskon['nominal'], 'IDR') ?> untuk semua produk.
    </div>
<?php endif; ?>

<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<!-- Table with stripped rows --><div class="row">
    <?php foreach ($product as $key => $item) : ?>
        <div class="col-lg-6">
            <?= form_open('keranjang') ?>
            <?php
            echo form_hidden('id', $item['id']);
            echo form_hidden('nama', $item['nama']);
            echo form_hidden('harga', $item['harga']);
            echo form_hidden('foto', $item['foto']);

            // Tambahkan input diskon jika session diskon tersedia
            if (session()->has('diskon_nominal')) {
                echo form_hidden('diskon', session()->get('diskon_nominal'));
            } else {
                echo form_hidden('diskon', 0); // default
            }
            ?>
            <div class="card mt-4">
                <div class="card-body">
                    <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" alt="..." width="300px">
                    <h5 class="card-title"><?php echo $item['nama'] ?><br>
                        <small class="text-muted">
                            <?php echo number_to_currency($item['harga'], 'IDR') ?>
                            <?php if (session()->has('diskon_nominal')) : ?>
                                <br><span class="badge bg-success">Diskon <?= number_to_currency(session()->get('diskon_nominal'), 'IDR') ?></span>
                            <?php endif; ?>
                        </small>
                    </h5>
                    <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>

<!-- End Table with stripped rows -->
<?= $this->endSection() ?>