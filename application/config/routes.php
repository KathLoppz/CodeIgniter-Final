<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Hospitalizacion/dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'Hospitalizacion/dashboard';

$route['hospitalizacion'] = 'Hospitalizacion/index';
$route['hospitalizacion/crear'] = 'Hospitalizacion/crear';
$route['hospitalizacion/guardar'] = 'Hospitalizacion/guardar';
$route['hospitalizacion/editar/(:num)'] = 'Hospitalizacion/editar/$1';
$route['hospitalizacion/actualizar/(:num)'] = 'Hospitalizacion/actualizar/$1';
$route['hospitalizacion/eliminar/(:num)'] = 'Hospitalizacion/eliminar/$1';

$route['hospitalizacion/lista_hospitalizaciones']           = 'Hospitalizacion/lista_hospitalizaciones';
$route['hospitalizacion/guardar_hospitalizacion']           = 'Hospitalizacion/guardar_hospitalizacion';
$route['hospitalizacion/actualizar_hospitalizacion/(:num)'] = 'Hospitalizacion/actualizar_hospitalizacion/$1';
$route['hospitalizacion/eliminar_hospitalizacion/(:num)']   = 'Hospitalizacion/eliminar_hospitalizacion/$1';

$route['hospitalizacion/lista_salas']            = 'Hospitalizacion/lista_salas';
$route['hospitalizacion/guardar_sala']           = 'Hospitalizacion/guardar_sala';
$route['hospitalizacion/actualizar_sala/(:num)'] = 'Hospitalizacion/actualizar_sala/$1';
$route['hospitalizacion/eliminar_sala/(:num)']   = 'Hospitalizacion/eliminar_sala/$1';
 
$route['hospitalizacion/lista_tipos_diagnostico']            = 'Hospitalizacion/lista_tipos_diagnostico';
$route['hospitalizacion/guardar_tipo_diagnostico']           = 'Hospitalizacion/guardar_tipo_diagnostico';
$route['hospitalizacion/actualizar_tipo_diagnostico/(:num)'] = 'Hospitalizacion/actualizar_tipo_diagnostico/$1';
$route['hospitalizacion/eliminar_tipo_diagnostico/(:num)']   = 'Hospitalizacion/eliminar_tipo_diagnostico/$1';

$route['hospitalizacion/consulta_hospitalizados'] = 'Hospitalizacion/consulta_hospitalizados';
$route['hospitalizacion/consulta_por_sala']       = 'Hospitalizacion/consulta_por_sala';
