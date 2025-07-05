<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('home', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');

$routes->get('register', 'AuthController::registerForm');
$routes->post('register', 'AuthController::register');

$routes->get('logout', 'AuthController::logout');

// Produk
$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

// Keranjang
$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
$routes->post('konfirmasi-diterima/(:num)', 'ProfileController::konfirmasiDiterima/$1', ['filter' => 'auth']);

$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->get('faq', 'Home::faq', ['filter' => 'auth']);
$routes->get('profile', 'ProfileController::index', ['filter' => 'auth']);
$routes->get('contact', 'ContactController::index', ['filter' => 'auth']);
$routes->resource('api', [
    'controller' => 'ApiController',
    'only' => ['index'] // hanya endpoint GET /api yang diaktifkan
]);


$routes->get('invoice', 'TransaksiController::invoiceRedirect');
$routes->get('invoice/(:num)', 'TransaksiController::invoice/$1');
$routes->get('invoice-detail/(:num)', 'InvoiceController::show/$1');
$routes->get('invoice-detail-pdf/(:num)', 'InvoiceController::print/$1');

// Kategori
$routes->get('kategori', 'KategoriController::index', ['filter' => 'auth']);
$routes->post('kategori', 'KategoriController::create', ['filter' => 'auth']);
$routes->post('kategori/edit/(:num)', 'KategoriController::edit/$1', ['filter' => 'auth']);
$routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1', ['filter' => 'auth']);

// Dashboard
$routes->get('admin', 'DashboardController::index', ['filter' => 'auth']);

// Konsumen
$routes->get('konsumen', 'KonsumenController::index', ['filter' => 'auth']);

// Order
$routes->get('order', 'OrderController::index');
$routes->get('order/konfirmasi-bayar/(:num)', 'OrderController::konfirmasiBayar/$1');
$routes->get('order/konfirmasi-kirim/(:num)', 'OrderController::konfirmasiKirim/$1');

// Laporan Global
$routes->get('laporan/global', 'LaporanController::laporanGlobal', ['filter' => 'auth']);
$routes->get('laporan/export-global/pdf', 'LaporanController::exportGlobalPdf');
$routes->get('laporan/export-global/excel', 'LaporanController::exportGlobalExcel');

// Laporan Periodik
$routes->get('laporan/periodik', 'LaporanPeriodikController::index');
$routes->post('laporan/periodik', 'LaporanPeriodikController::filter');
$routes->get('laporan/periodik/pdf', 'LaporanPeriodikController::export_pdf');
$routes->get('laporan/periodik/excel', 'LaporanPeriodikController::export_excel');

// Laporan Pendapatan
$routes->get('laporan/pendapatan', 'LaporanPendapatanController::index', ['filter' => 'auth']);
$routes->post('laporan/pendapatan/filter', 'LaporanPendapatanController::filter');
$routes->get('laporan/pendapatan/pdf', 'LaporanPendapatanPdfController::pendapatanPdf');
$routes->get('laporan/pendapatan/excel', 'LaporanPendapatanPdfController::pendapatanExcel');

// Diskon
$routes->get('diskon', 'DiskonController::index', ['filter' => 'auth']);
$routes->post('diskon/create', 'DiskonController::create');
$routes->post('diskon/update/(:num)', 'DiskonController::update/$1');
$routes->get('diskon/delete/(:num)', 'DiskonController::delete/$1');

// Auth Google
$routes->get('auth/google', 'AuthController::googleLogin');
$routes->get('auth/google/callback', 'AuthController::googleCallback');

// Checkout tambahan
$routes->post('buy', 'CheckoutController::buy');
$routes->get('checkout/success', 'CheckoutController::success');
$routes->post('upload-bukti/(:num)', 'TransaksiController::uploadBuktiPembayaran/$1');

// Kontak
$routes->post('kontak/kirim', 'KontakController::kirim');

// Search
$routes->post('/search', 'SearchController::index');
$routes->post('search', 'Home::search');
