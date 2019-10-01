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
|	http://codeigniter.com/user_guide/general/routing.html
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
//////RUTA POR DEFECTO//////
$route['default_controller'] = 'Init';

//////AUTHENTICATE ///////
//$route['auth/login'] = 'auth/Auth/login';
//$route['auth/logout'] = 'auth/Auth/logout';
//$route['mainten/users'] = 'auth/Mainten/users';
//$route['mainten/level'] = 'auth/Mainten/levelsetup';
//$route['upload/do_upload'] = 'admin/Mainten/do_uploads';

$route['auth/login'] = 'Init';
$route['auth/logout'] = 'Init/logout';

////////SETUP USERS////////
$route['users'] = 'Users/setup';
$route['users/list'] = 'Users/setup/list';
$route['users/ajax_list'] = 'Users/setup/ajax_list';
$route['users/ajax_list_info'] = 'Users/setup/ajax_list_info';
$route['users/insert_validation'] = 'Users/setup/insert_validation';
$route['users/insert'] = 'Users/setup/insert';
$route['users/update_validation/(:any)'] = 'Users/setup/update_validation/$1';
$route['users/export'] = 'Users/setup/export';
$route['users/ajax_relation_n_n'] = 'Users/setup/ajax_relation_n_n';
$route['users/(:any)/(:any)'] = 'Users/setup/$1/$2';

////////ADMIN PERMISSIONS////////
$route['permissions'] = 'Permissions/setup';
$route['permissions/list'] = 'Permissions/setup/list';
$route['permissions/ajax_list'] = 'Permissions/setup/ajax_list';
$route['permissions/ajax_list_info'] = 'Permissions/setup/ajax_list_info';
$route['permissions/insert_validation'] = 'Permissions/setup/insert_validation';
$route['permissions/insert'] = 'Permissions/setup/insert';
$route['permissions/update_validation/(:any)'] = 'Permissions/setup/update_validation/$1';
$route['permissions/export'] = 'Permissions/setup/export';
$route['permissions/ajax_relation_n_n'] = 'Permissions/setup/ajax_relation_n_n';
$route['permissions/(:any)/(:any)'] = 'Permissions/setup/$1/$2';

////////////NAVIGATIONS////////////////////
$route['pages/(:any)'] = 'Init/pages/$1';

////////SETUP////////
//$route['setup/users'] = 'admin/Access';
$route['setup'] = 'setup/Setup/index';

////////FARM////////
$route['farm'] = 'farm/Farm/farm_list';
$route['farm/list'] = 'farm/Farm/farm_list/list';
$route['farm/ajax_list'] = 'farm/Farm/farm_list/ajax_list';
$route['farm/export'] = 'farm/Farm/farm_list/export';
$route['farm/delete/(:any)'] = 'farm/Farm/farm_list/delete/$1';
$route['farm/add/(:any)'] = 'farm/Farm/index/$1';
$route['farm/farmers/(:any)/(:any)'] = 'farm/Farm/index/$1/$2';

////////ILLNESS////////
$route['illness'] = 'illness/Illness/case_list';
$route['illness/list'] = 'illness/Illness/case_list/list';
$route['illness/ajax_list'] = 'illness/Illness/case_list/ajax_list';
$route['illness/export'] = 'illness/Illness/case_list/export';
$route['illness/delete/(:any)'] = 'illness/Illness/case_list/delete/$1';
$route['illness/add/(:any)'] = 'illness/Illness/index/$1';
$route['illness/case/(:any)/(:any)'] = 'illness/Illness/index/$1/$2';

////////COMMODITY IMP////////
$route['comimp'] = 'comimp/Comimp/Comimp_list';
$route['comimp/list'] = 'comimp/Comimp/Comimp_list/list';
$route['comimp/ajax_list'] = 'comimp/Comimp/Comimp_list/ajax_list';
$route['comimp/export'] = 'comimp/Comimp/Comimp_list/export';
$route['comimp/delete/(:any)'] = 'comimp/Comimp/Comimp_list/delete/$1';
$route['comimp/add/(:any)'] = 'comimp/Comimp/index/$1';
$route['comimp/licence/(:any)/(:any)'] = 'comimp/Comimp/index/$1/$2';

////////COMMODITY EXP////////
$route['comexp'] = 'comexp/Comexp/Comexp_list';
$route['comexp/list'] = 'comexp/Comexp/Comexp_list/list';
$route['comexp/ajax_list'] = 'comexp/Comexp/Comexp_list/ajax_list';
$route['comexp/export'] = 'comexp/Comexp/Comexp_list/export';
$route['comexp/delete/(:any)'] = 'comexp/Comexp/Comexp_list/delete/$1';
$route['comexp/add/(:any)'] = 'comexp/Comexp/index/$1';
$route['comexp/licence/(:any)/(:any)'] = 'comexp/Comexp/index/$1/$2';

////////ANIMAL IMP////////
$route['animalimp'] = 'animalimp/Animalimp/Animalimp_list';
$route['animalimp/list'] = 'animalimp/Animalimp/Animalimp_list/list';
$route['animalimp/ajax_list'] = 'animalimp/Animalimp/Animalimp_list/ajax_list';
$route['animalimp/export'] = 'animalimp/Animalimp/Animalimp_list/export';
$route['animalimp/delete/(:any)'] = 'animalimp/Animalimp/Animalimp_list/delete/$1';
$route['animalimp/add/(:any)'] = 'animalimp/Animalimp/index/$1';
$route['animalimp/licence/(:any)/(:any)'] = 'animalimp/Animalimp/index/$1/$2';

////////ANIMAL EXP////////
$route['animalexp'] = 'animalexp/Animalexp/Animalexp_list';
$route['animalexp/list'] = 'animalexp/Animalexp/Animalexp_list/list';
$route['animalexp/ajax_list'] = 'animalexp/Animalexp/Animalexp_list/ajax_list';
$route['animalexp/export'] = 'animalexp/Animalexp/Animalexp_list/export';
$route['animalexp/delete/(:any)'] = 'animalexp/Animalexp/Animalexp_list/delete/$1';
$route['animalexp/add/(:any)'] = 'animalexp/Animalexp/index/$1';
$route['animalexp/licence/(:any)/(:any)'] = 'animalexp/Animalexp/index/$1/$2';

///////Abbatoir/////////
//$route['abbatoir'] = 'abbatoir/Abbatoir/index';
//$route['abbatoir/add'] = 'abbatoir/Abbatoir/abbatoir_add';
////////TRANFER SALE////////
$route['transfer'] = 'transfer/Transfer/transfer_list';
$route['transfer/list'] = 'transfer/Transfer/transfer_list/list';
$route['transfer/ajax_list'] = 'transfer/Transfer/transfer_list/ajax_list';
$route['transfer/export'] = 'transfer/Transfer/transfer_list/export';
$route['transfer/delete/(:any)'] = 'transfer/Transfer/transfer_list/delete/$1';
$route['transfer/add/(:any)'] = 'transfer/Transfer/index/$1';

////////SPECIMEN////////
$route['specimen'] = 'specimen/Specimen_permit/Specimen_Permit_list';
$route['specimen/list'] = 'specimen/Specimen_permit/Specimen_Permit_list/list';
$route['specimen/ajax_list'] = 'specimen/Specimen_permit/Specimen_Permit_list/ajax_list';
$route['specimen/export'] = 'specimen/Specimen_permit/Specimen_Permit_list/export';
$route['specimen/delete/(:any)'] = 'specimen/Specimen_permit/Specimen_Permit_list/delete/$1';
$route['specimen/add/(:any)'] = 'specimen/Specimen_permit/index/$1';
$route['specimen/permit/(:any)/(:any)'] = 'specimen/Specimen_permit/index/$1/$2';

////////SURVEILLANCE////////
$route['surveillance'] = 'surveillance/Surveillance/Surveillance_list';
$route['surveillance/list'] = 'surveillance/Surveillance/Surveillance_list/list';
$route['surveillance/ajax_list'] = 'surveillance/Surveillance/Surveillance_list/ajax_list';
$route['surveillance/export'] = 'surveillance/Surveillance/Surveillance_list/export';
$route['surveillance/delete/(:any)'] = 'surveillance/Surveillance/Surveillance_list/delete/$1';
$route['surveillance/add/(:any)'] = 'surveillance/Surveillance/index/$1';
$route['surveillance/data/(:any)/(:any)'] = 'surveillance/Surveillance/index/$1/$2';

////////REPORT////////
$route['report/import-licences'] = 'report/Report/rpt_import_licences';
$route['report/animal-imported'] = 'report/Report/rpt_animal_imported';
$route['report/export-animals'] = 'report/Report/rpt_export_animals';
$route['report/export-meats'] = 'report/Report/rpt_export_meats';
$route['report/animal-illness-cases'] = 'report/Report/rpt_animal_illness_cases';
$route['report/withdrawal-period'] = 'report/Report/rpt_withdrawal_period';
$route['report/number-of-biological'] = 'report/Report/rpt_number_of_biological';
$route['report/surveillance'] = 'report/Report/rpt_surveillance';

///////CUALQUIER COSA//////
//$route['any'] = 'any/Any/index';

////////DASHBOARD////////
$route['dashboard'] = 'dashboard/Dashboard/index';
////////GENERAL DEFAULT////////
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

////////AUTH////////
//$route['^(security)/(.+)$'] = $route['default_controller']."/index/$1/$2";