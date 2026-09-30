<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/login', 'Auth::login');
$routes->post('/login/masuk', 'Auth::masuk');
$routes->get('/password/forgot', 'Auth::forgotPassword');
$routes->post('/password/forgot', 'Auth::sendPasswordReset');
$routes->get('/password/reset', 'Auth::showPasswordReset');
$routes->post('/password/reset', 'Auth::updatePassword');

$routes->get('/register', 'Auth::register');
$routes->post('/register/simpan', 'Auth::simpanRegister');

$routes->get('/logout', 'Auth::logout');

$routes->get('/', 'Auth::login');
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/akun/reset-password', 'AdminAccount::index');
$routes->post('/admin/akun/reset-password', 'AdminAccount::updatePassword');


// =========================
// BERITA
// =========================

$routes->get('/admin/berita', 'Berita::index');
$routes->post('/admin/berita/simpan', 'Berita::simpan');
$routes->get('/admin/berita/edit/(:num)', 'Berita::edit/$1');
$routes->post('/admin/berita/update/(:num)', 'Berita::update/$1');
$routes->get('/admin/berita/hapus/(:num)', 'Berita::hapus/$1');


// =========================
// AGENDA
// =========================

$routes->get('/admin/agenda', 'Agenda::index');

$routes->get(
    '/admin/agenda/edit/(:num)',
    'Agenda::edit/$1'
);

$routes->get(
    '/admin/agenda/detail/(:num)',
    'Agenda::detail/$1'
);

$routes->post(
    '/admin/agenda/update/(:num)',
    'Agenda::update/$1'
);

$routes->post(
    '/admin/agenda/simpan',
    'Agenda::simpan'
);

$routes->get(
    '/admin/agenda/hapus/(:num)',
    'Agenda::hapus/$1'
);


// =========================
// DOKUMENTASI AGENDA
// =========================

$routes->get(
    '/admin/agenda/dokumentasi/hapus/(:num)',
    'Agenda::hapusDokumentasi/$1'
);


// =========================
// LAPORAN
// =========================

$routes->get(
    '/admin/laporan',
    'Laporan::index'
);
$routes->get('/admin/laporan/cetak/(:num)', 'Laporan::cetak/$1');
// ===============================
// ROUTE PEGAWAI
// ===============================

$routes->get('/pegawai', 'Pegawai::index');

$routes->get('/pegawai/agenda', 'Pegawai::agenda');
$routes->get('/pegawai/agenda/tambah', 'Pegawai::tambah');
$routes->post('/pegawai/agenda/simpan', 'Pegawai::simpan');

$routes->get('/pegawai/agenda/detail/(:num)', 'Pegawai::detail/$1');

$routes->get('/pegawai/agenda/detail/(:num)', 'Pegawai::detail/$1');

$routes->get('/pegawai/laporan', 'Pegawai::laporan');

$routes->get('/pegawai/laporan/cetak/(:num)', 'Pegawai::cetak/$1');