<?
//error_reporting(E_ALL);
include 'autoloader.php';

$app = new MVC();
$app->db = new Database('.config.php');
$app->stripPath = '/canteen-mvc';

$app->route(GET,  '',			['Canteen', 'index']);
$app->route(GET,  'index',		['Canteen', 'index']);
$app->route(GET,  'today',		['Canteen', 'today']);
$app->route(GET,  'week',		['Canteen', 'week']);
$app->route(GET,  'passes',		['Canteen', 'passes']);

$app->route(POST, 'passes',		['Canteen', 'doPasses']);
$app->route(POST, 'rate',		['Canteen', 'doRate']);

$app->route(GET,  'login',		['UserMgmt', 'login']);
$app->route(POST, 'login',		['UserMgmt', 'doLogin']);
$app->route(GET,  'register',	['UserMgmt', 'register']);
$app->route(POST, 'register',	['UserMgmt', 'doRegister']);
$app->route(GET,  'reset',		['UserMgmt', 'reset']);
$app->route(POST, 'reset',		['UserMgmt', 'doReset']);
$app->route(GET,  'logout',		['UserMgmt', 'doLogout']);

$app->route(GET,  'admin',		  ['Admin', 'index']);
$app->route(GET,  'admin-foods',  ['Admin', 'foods']);
$app->route(POST, 'admin-foods',  ['Admin', 'foods']);
$app->route(GET,  'admin-menu',	  ['Admin', 'menu']);
$app->route(POST, 'admin-menu',	  ['Admin', 'menu']);
$app->route(GET,  'admin-passes', ['Admin', 'passes']);
$app->route(POST, 'admin-passes', ['Admin', 'passes']);
$app->route(GET,  'admin-orders', ['Admin', 'orders']);
$app->route(POST, 'admin-orders', ['Admin', 'orders']);
$app->route(GET,  'admin-users',  ['Admin', 'users']);
$app->route(POST, 'admin-users',  ['Admin', 'users']);

$app->route(SPEC,  404,		    ['Canteen', 'notFound']);
$app->route(SPEC,  EXC,		    ['Canteen', 'handleException']);
$app->route(SPEC,  ERR,		    ['Canteen', 'handleError']);

$app->run();