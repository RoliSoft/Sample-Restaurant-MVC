<?
include 'autoloader.php';

$app = new MVC();
$app->db = new Database('.config.php');
$app->stripPath = '/webproj';

$app->route(GET,  '',			['Restaurant', 'index']);
$app->route(GET,  'index',		['Restaurant', 'index']);
$app->route(GET,  'today',		['Restaurant', 'today']);
$app->route(GET,  'week',		['Restaurant', 'week']);
$app->route(GET,  [':(monday|tuesday|wednesday|thursday|saturday|friday)'], ['Restaurant', 'day']);
$app->route(GET,  ['food/', ':([\w-]+)'], ['Restaurant', 'food']);

$app->route(GET,  'login',		['Restaurant', 'login']);
$app->route(POST, 'login',		['Restaurant', 'doLogin']);
$app->route(GET,  'register',	['Restaurant', 'register']);
$app->route(POST, 'register',	['Restaurant', 'doRegister']);
$app->route(GET,  'reset',		['Restaurant', 'reset']);
$app->route(POST, 'reset',		['Restaurant', 'doReset']);
$app->route(GET,  'logout',		['Restaurant', 'doLogout']);

$app->route(POST, 'rate',		['Restaurant', 'doRate']);

$app->run();
