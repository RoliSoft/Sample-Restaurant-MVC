<?
include 'autoloader.php';

$app = new MVC();
$app->stripPath = '/webproj';

$app->route(GET,  '',			['Restaurant', 'Index']);
$app->route(GET,  'today',		['Restaurant', 'Today']);
$app->route(GET,  'week',		['Restaurant', 'Week']);
$app->route(GET,  [':(monday|tuesday|wednesday|thursday|saturday|friday)'], ['Restaurant', 'Day']);
$app->route(GET,  ['food/', ':([\w-]+)'], ['Restaurant', 'Food']);

$app->route(GET,  'login',		['Restaurant', 'Login']);
$app->route(POST, 'login',		['Restaurant', 'DoLogin']);
$app->route(GET,  'register',	['Restaurant', 'Register']);
$app->route(POST, 'register',	['Restaurant', 'DoRegister']);
$app->route(GET,  'reset',		['Restaurant', 'Reset']);
$app->route(POST, 'reset',		['Restaurant', 'DoReset']);
$app->route(POST, 'logout',		['Restaurant', 'DoLogout']);

$app->route(POST, 'rate',		['Restaurant', 'DoRate']);

$app->run();
