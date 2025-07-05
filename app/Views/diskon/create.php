<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Tambah Diskon</h2>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<form action="<?= site_url('diskon/store') ?>" method="post">
    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal') ?>">
    </div>
    <div class="mb-3">
        <label>Nominal</label>
        <input type="number" name="nominal" class="form-control" value="<?= old('nominal') ?>">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('diskon') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>