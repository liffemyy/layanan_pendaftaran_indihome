<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('paket', 'Paket::index');
$routes->get('paket/bandingkan', 'Paket::bandingkan');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::prosesRegister');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::prosesLogin');
$routes->get('logout', 'Auth::logout');
$routes->get('daftar/mulai', 'Daftar::mulai');
$routes->get('daftar/lokasi', 'Daftar::lokasi');
$routes->post('daftar/lokasi', 'Daftar::prosesLokasi');
$routes->get('daftar/data-diri', 'Daftar::dataDiri');
$routes->post('daftar/data-diri', 'Daftar::prosesDataDiri');
$routes->get('daftar/checkout', 'Daftar::checkout');
$routes->post('daftar/checkout', 'Daftar::prosesCheckout');
$routes->get('daftar/selesai', 'Daftar::selesai');
$routes->get('akun', 'Akun::index');
$routes->get('admin/login', 'AdminAuth::login');
$routes->post('admin/login', 'AdminAuth::prosesLogin');
$routes->get('admin/logout', 'AdminAuth::logout');
$routes->get('admin/dashboard', 'AdminDashboard::index');
$routes->get('kontak', 'Kontak::index');
$routes->post('ai-assistant/balas', 'AiAssistant::balas');
$routes->get('cek-status', 'CekStatus::index');
$routes->post('cek-status', 'CekStatus::cari');
$routes->get('admin/pendaftaran', 'AdminPendaftaran::index');
$routes->post('admin/pendaftaran/update-status', 'AdminPendaftaran::updateStatus');
$routes->get('admin/pendaftaran/export', 'AdminPendaftaran::export');
$routes->get('keluhan', 'Keluhan::formLangsung');
$routes->get('admin/paket', 'AdminPaket::index');
$routes->get('admin/paket/tambah', 'AdminPaket::tambah');
$routes->post('admin/paket/simpan-tambah', 'AdminPaket::simpanTambah');
$routes->get('admin/paket/edit/(:num)', 'AdminPaket::edit/$1');
$routes->post('admin/paket/simpan-edit/(:num)', 'AdminPaket::simpanEdit/$1');
$routes->get('admin/paket/hapus/(:num)', 'AdminPaket::hapus/$1');