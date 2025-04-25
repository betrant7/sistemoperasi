<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/login/logingoogle', 'Home::loginGoogle');
$routes->add('/loginproses', 'Home::loginProses');
$routes->get('/logout', 'Home::logout');

$routes->get('/lengkapidata', 'lengkapiData::index');
$routes->add('/updatedataproses', 'lengkapiData::updateDataProses');

$routes->get('/register', 'Register::index');
$routes->add('/registerproses', 'Register::registerProses');

$routes->get('/adminberanda', 'adminBeranda::index');

$routes->get('/datamahasiswa', 'dataMahasiswa::index');
$routes->get('/datamahasiswa/delete/(:num)', 'dataMahasiswa::deleteUser/$1');

$routes->get('/datamateri', 'dataMateri::index');
$routes->add('/datamateri/updatestatus/(:num)', 'dataMateri::updateStatus/$1');
$routes->get('/datamateri/tambah', 'dataMateri::tambah');
$routes->add('/datamateri/tambah/tambahproses', 'dataMateri::tambahProses');
$routes->get('/datamateri/update/(:num)', 'dataMateri::update/$1');
$routes->add('/datamateri/update/updateproses', 'dataMateri::updateProses');
$routes->get('/datamateri/detail/(:num)', 'dataMateri::details/$1');
$routes->get('/datamateri/delete/(:num)', 'dataMateri::delete/$1');

$routes->add('/datasubmateri/tambah/tambahproses', 'dataSubMateri::tambahSubProses');
$routes->get('/datasubmateri/tambah/(:num)', 'dataSubMateri::tambahSub/$1');
$routes->add('/datasubmateri/update/updateproses', 'dataSubMateri::updateSubProses');
$routes->get('/datasubmateri/update/(:num)', 'dataSubMateri::updateSub/$1');
$routes->get('/datasubmateri/(:num)', 'dataSubMateri::index/$1');
$routes->get('/datasubmateri/delete/(:num)', 'dataSubMateri::deleteSub/$1');

$routes->get('/laporan', 'laporanProgres::index');
$routes->post('/laporan/getprogres', 'laporanProgres::getProgres');
$routes->get('/laporan/detail/(:num)', 'laporanProgres::detail/$1');

$routes->get('/console/login', 'ProxmoxConsole::login');
$routes->get('/console/(:num)', 'Console::index/$1');

$routes->get('/beranda', 'Frondend\Beranda::index');

$routes->get('/frondend/logout', 'Frondend\Beranda::logout');

$routes->get('/pilihos', 'Frondend\PilihOS::index');

$routes->get('/materi', 'Frondend\Materi::index');
$routes->get('/materi/pilih/(:num)', 'Frondend\Materi::pilihMateri/$1');
$routes->post('/materi/progres', 'Frondend\Materi::updateProgres');
$routes->post('/materi/selesai', 'Frondend\Materi::selesai');
$routes->get('/materi/submateri/(:num)', 'Frondend\Materi::subMateri/$1');