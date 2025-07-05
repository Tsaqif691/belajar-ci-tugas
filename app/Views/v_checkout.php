<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php
$jumlahItem = 0;
foreach ($items as $item) $jumlahItem += $item['qty'];
$diskon_total = ($diskon ?? 0) ;
?>

<div class="row">
    <div class="col-lg-6">
        <?= form_open_multipart('buy', 'class="row g-3"') ?>
        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga', 'value' => '']) ?>
        <div class="col-12">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" value="<?= session()->get('username'); ?>">
        </div>
        <div class="col-12">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
        <div class="col-12">
            <label for="kelurahan" class="form-label">Kelurahan</label>
            <select class="form-control" id="kelurahan" name="kelurahan" required></select>
            <input type="hidden" name="nama_kelurahan" id="nama_kelurahan">
        </div>
        <div class="col-12">
            <label for="layanan" class="form-label">Layanan</label>
            <select class="form-control" id="layanan" name="layanan" required></select>
        </div>
        <div class="col-12">
            <label for="ongkir" class="form-label">Ongkir</label>
            <input type="text" class="form-control" id="ongkir" name="ongkir" readonly>
        </div>
        <div class="col-12">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
        <?= form_close() ?>
    </div>

    <div class="col-lg-6">
        <div class="col-12">
           <table class="table">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Diskon</th>
            <th scope="col">Sub Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                <td><?= $item['qty'] ?></td>
                <td>
                    <?php 
                        $diskon_item = ($diskon ?? 0) * $item['qty'];
                        echo $diskon_item > 0 ? number_to_currency($diskon_item, 'IDR') : '-';
                    ?>
                </td>
                <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"></td>
            <td>Subtotal</td>
            <td><?= number_to_currency($total, 'IDR') ?></td>
        </tr>
        <?php if ($diskon_total > 0): ?>
            <tr>
                <td colspan="3"></td>
                <td>Total Diskon</td>
                <td>-<?= number_to_currency($diskon_total, 'IDR') ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="3"></td>
            <td>Total</td>
            <td><span id="total"><?= number_to_currency($total - $diskon_total, 'IDR') ?></span></td>
        </tr>
    </tbody>
</table>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function () {
        var ongkir = 0;
        var total = <?= $total ?>;
        var diskon = <?= $diskon ?? 0 ?>;
        var jumlahItem = <?= $jumlahItem ?>;
        var diskon_total = diskon ;

        hitungTotal();

        $('#kelurahan').select2({
            placeholder: 'Ketik nama kelurahan...',
            ajax: {
                url: '<?= base_url('get-location') ?>',
                dataType: 'json',
                delay: 1500,
                data: function (params) {
                    return { search: params.term };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id,
                                text: item.subdistrict_name + ", " + item.district_name + ", " + item.city_name + ", " + item.province_name + ", " + item.zip_code
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 3
        });

        $("#kelurahan").on('change', function () {
            var id_kelurahan = $(this).val();
            var nama_kelurahan = $('#kelurahan').select2('data')[0].text;
            $('#nama_kelurahan').val(nama_kelurahan);

            $("#layanan").empty();
            ongkir = 0;

            $.ajax({
                url: "<?= site_url('get-cost') ?>",
                type: 'GET',
                data: { 'destination': id_kelurahan },
                dataType: 'json',
                success: function (data) {
                    data.forEach(function (item) {
                        var text = item["description"] + " (" + item["service"] + ") : estimasi " + item["etd"];
                        $("#layanan").append($('<option>', {
                            value: item["cost"],
                            text: text
                        }));
                    });
                    hitungTotal();
                }
            });
        });

        $("#layanan").on('change', function () {
            ongkir = parseInt($(this).val());
            hitungTotal();
        });

        function hitungTotal() {
            let total_harga = total + ongkir - diskon_total;
            $("#ongkir").val(ongkir);
            $("#total").html("IDR " + total_harga.toLocaleString('id-ID'));
            $("#total_harga").val(total_harga);
        }
    });
</script>
<?= $this->endSection() ?>
