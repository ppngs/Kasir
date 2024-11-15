<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); // Halaman login
$routes->post('/login', 'Home::login'); // Proses login
$routes->get('/logout', 'Home::logout'); // Proses logout
$routes->post('/satuan/save', 'Satuan::save'); // Rute untuk menyimpan data satuan
$routes->post('/kategori/save', 'Kategori::save'); // Rute untuk menyimpan data kategori

// $routes->group('', ['filter' => 'auth'], function ($routes) {
//     $routes->get('dashboard', 'Dashboard::index');
//     $routes->get('penjualan', 'Penjualan::index');
//     $routes->get('masterdata', 'User::index');
//     $routes->get('laporan', 'Laporan::index');
//     $routes->get('setting', 'Setting::index');
//     $routes->get('logout', 'Home::logout');
// });


$routes->get('penjualan', 'Penjualan::index');
$routes->get('Laporan', 'Laporan::LaporanHarian');
$routes->get('Laporan/Bulanan', 'Laporan::LaporanBulanan');
$routes->get('Laporan/Tahunan', 'Laporan::LaporanTahunan');
$routes->setAutoRoute(TRUE); // Mengaktifkan auto routing
