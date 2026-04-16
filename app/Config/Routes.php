<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Site::home');
$routes->group('admin', static function ($routes): void {
    $routes->get('login', 'Admin\AuthController::login');
    $routes->post('login', 'Admin\AuthController::attemptLogin');
    $routes->get('logout', 'Admin\AuthController::logout', ['filter' => 'adminauth']);

    $routes->get('/', 'Admin\DashboardController::index', ['filter' => 'adminauth']);
    $routes->get('pages', 'Admin\PageController::index', ['filter' => 'adminauth']);
    $routes->get('pages/new', 'Admin\PageController::new', ['filter' => 'adminauth']);
    $routes->post('pages', 'Admin\PageController::create', ['filter' => 'adminauth']);
    $routes->post('pages/import', 'Admin\PageController::import', ['filter' => 'adminauth']);
    $routes->get('pages/(:num)/edit', 'Admin\PageController::edit/$1', ['filter' => 'adminauth']);
    $routes->post('pages/(:num)', 'Admin\PageController::update/$1', ['filter' => 'adminauth']);
    $routes->post('pages/(:num)/delete', 'Admin\PageController::delete/$1', ['filter' => 'adminauth']);

    $routes->get('notices', 'Admin\NoticeController::index', ['filter' => 'adminauth']);
    $routes->get('notices/new', 'Admin\NoticeController::new', ['filter' => 'adminauth']);
    $routes->post('notices', 'Admin\NoticeController::create', ['filter' => 'adminauth']);
    $routes->get('notices/(:num)/edit', 'Admin\NoticeController::edit/$1', ['filter' => 'adminauth']);
    $routes->post('notices/(:num)', 'Admin\NoticeController::update/$1', ['filter' => 'adminauth']);
    $routes->post('notices/(:num)/delete', 'Admin\NoticeController::delete/$1', ['filter' => 'adminauth']);

    $routes->get('officers', 'Admin\OfficerController::index', ['filter' => 'adminauth']);
    $routes->get('officers/new', 'Admin\OfficerController::new', ['filter' => 'adminauth']);
    $routes->post('officers', 'Admin\OfficerController::create', ['filter' => 'adminauth']);
    $routes->get('officers/(:num)/edit', 'Admin\OfficerController::edit/$1', ['filter' => 'adminauth']);
    $routes->post('officers/(:num)', 'Admin\OfficerController::update/$1', ['filter' => 'adminauth']);
    $routes->post('officers/(:num)/delete', 'Admin\OfficerController::delete/$1', ['filter' => 'adminauth']);
});
$routes->get('views/search', 'PortalView::search');
$routes->post('ajax/post/opinion-form', 'Ajax::submitOpinion');
$routes->get('ajax/(:segment)', 'Ajax::proxy/$1');
$routes->get('ajax/(:segment)/(:segment)', 'Ajax::proxy/$1/$2');
$routes->get('ajax/(:segment)/(:segment)/(:segment)', 'Ajax::proxy/$1/$2/$3');
$routes->get('ajax/(:segment)/(:segment)/(:segment)/(:segment)', 'Ajax::proxy/$1/$2/$3/$4');
$routes->get('ajax/(:segment)/(:segment)/(:segment)/(:segment)/(:segment)', 'Ajax::proxy/$1/$2/$3/$4/$5');

$routes->get('run-migrate', function() {
    $migrate = \Config\Services::migrations();
    try {
        $migrate->latest();
        return "Migration successful!";
    } catch (\Exception $e) {
        return "Migration failed: " . $e->getMessage();
    }
});

$routes->get('run-seed', function() {
    $seeder = \Config\Database::seeder();
    try {
        $seeder->call('AdminUserSeeder');
        $seeder->call('CmsPageSeeder');
        $seeder->call('NoticeSeeder');
        $seeder->call('OfficerSeeder');
        return "Seeding successful! Your database is now populated.";
    } catch (\Exception $e) {
        return "Seeding failed: " . $e->getMessage();
    }
});

$routes->group('pages', static function ($routes): void {
    $routes->get('notices', 'Site::notices');
    $routes->get('notices/(:segment)', 'Site::notice/$1');
    $routes->get('officers', 'Site::officers');
    $routes->get('officers/(:segment)', 'Site::officer/$1');
    $routes->get('common-documents', 'Site::commonDocuments');
    $routes->get('common-documents/(:segment)', 'Site::commonDocument/$1');
    $routes->get('static-pages/(:segment)', 'Site::staticPage/$1');
    $routes->get('files/(:segment)', 'Site::filePage/$1');
    $routes->get('news', 'Site::newsArchive');
    $routes->get('news/(:segment)', 'Site::news/$1');
    $routes->get('external-links', 'Site::externalLinks');
    $routes->get('external-links/(:segment)', 'Site::externalLink/$1');
    $routes->get('(:segment)', 'Pages::index/$1');
    $routes->get('(:segment)/(:segment)', 'Pages::detail/$1/$2');
});

$routes->get('p/(:segment)', 'Site::cmsPage/$1');

$routes->get('(:segment)', 'Site::mirror/$1');
$routes->get('(:segment)/(:segment)', 'Site::mirror/$1/$2');
$routes->get('(:segment)/(:segment)/(:segment)', 'Site::mirror/$1/$2/$3');
$routes->get('(:segment)/(:segment)/(:segment)/(:segment)', 'Site::mirror/$1/$2/$3/$4');
$routes->get('(:segment)/(:segment)/(:segment)/(:segment)/(:segment)', 'Site::mirror/$1/$2/$3/$4/$5');
$routes->get('(:segment)/(:segment)/(:segment)/(:segment)/(:segment)/(:segment)', 'Site::mirror/$1/$2/$3/$4/$5/$6');
