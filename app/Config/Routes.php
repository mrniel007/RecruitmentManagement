<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\Candidatos;

$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

// Home Routes

$routes->get('logout', 'Home::logout');

// End Home Routes

// Login Routes

$routes->get('login', 'Login::index');
$routes->get('signin', 'Login::signin');
$routes->post('signin', 'Login::signin');

// End Login Routes


// Register Routes

$routes->get('registro', 'Login::registerPage');
$routes->post('register', 'Login::register');

// End Register Routes


// Idiomas Routes

$routes->get('idiomas', 'Idiomas::index');
$routes->post('addIdioma', 'Idiomas::addIdioma');
$routes->post('toggleIdioma', 'Idiomas::toggleIdioma');

// End Idiomas Routes

// Competencias Routes

$routes->get('competencias', 'Competencias::index');
$routes->post('addCompetencias', 'Competencias::addCompetencias');
$routes->post('toggleCompetencias', 'Competencias::toggleCompetencias');

// End Competencias Routes

// Capacitaciones Routes

$routes->get('capacitaciones', 'Capacitaciones::index');
$routes->post('addCapacitaciones', 'Capacitaciones::addCapacitaciones');
$routes->post('inscribir', 'Capacitaciones::inscribir');

// End Capacitaciones Routes

// Puestos Routes

$routes->get('puestos', 'Puestos::index');
$routes->post('addPuesto', 'Puestos::addPuesto');
$routes->post('getPuesto', 'Puestos::getPuesto');
$routes->post('editPuesto', 'Puestos::editPuesto');

// End Puestos Routes

// UserInfo Routes

$routes->get('userinfo', 'Userinfo::index');
$routes->post('addExperiencia', 'Userinfo::addExperiencia');
$routes->post('editProfile', 'Userinfo::editProfile');
$routes->post('toggleUserComp', 'Userinfo::toggleUserComp');

// End UserInfo Routes

// Vacantes Routes

$routes->get('vacantes', 'Vacantes::index');
$routes->post('getVacante', 'Vacantes::getVacante');
$routes->post('postular', 'Vacantes::postular');

// End Vacantes

// Candidatos Routes

$routes->get('candidatos', 'Candidatos::index');
$routes->post('getCandidato', 'Candidatos::getCandidato');
$routes->post('contratar', 'Candidatos::contratar');

// End Candidatos Routes

// Reportes Routes

$routes->get('reportes', 'Reportes::index');
$routes->post('getReporte', 'Reportes::getReporte');

// End Reportes Routes