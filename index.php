<?
include 'autoloader.php';

$app = new MVC();
$app->db = new Database('.config.php');
$app->stripPath = '/webproj';

$app->route(GET,  '',			['Canteen', 'index']);
$app->route(GET,  'index',		['Canteen', 'index']);
$app->route(GET,  'today',		['Canteen', 'today']);
$app->route(GET,  'week',		['Canteen', 'week']);
$app->route(GET,  [':(monday|tuesday|wednesday|thursday|saturday|friday)'], ['Canteen', 'day']);
$app->route(GET,  ['food-', ':([\w-]+)'], ['Canteen', 'food']);

$app->route(POST, 'rate',		['Canteen', 'doRate']);

$app->route(GET,  'login',		['UserMgmt', 'login']);
$app->route(POST, 'login',		['UserMgmt', 'doLogin']);
$app->route(GET,  'register',	['UserMgmt', 'register']);
$app->route(POST, 'register',	['UserMgmt', 'doRegister']);
$app->route(GET,  'reset',		['UserMgmt', 'reset']);
$app->route(POST, 'reset',		['UserMgmt', 'doReset']);
$app->route(GET,  'logout',		['UserMgmt', 'doLogout']);

$app->route(SPEC,  404,		    ['Canteen', 'notFound']);

$app->run();
