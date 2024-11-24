<?php
define('DIR_ROOT', './');
define('DIR_CORE', DIR_ROOT . 'core/');
define('DIR_MODULES', DIR_ROOT . 'modules/');
define('DIR_PUBLIC', DIR_ROOT . 'public/');
define('DIR_PUBLIC_JS', DIR_PUBLIC . 'js/');
define('DIR_PUBLIC_CSS', DIR_PUBLIC . 'css/');
define('DIR_PUBLIC_IMAGES', DIR_PUBLIC . 'slike/');
define('DIR_VIEW', DIR_ROOT . 'template/');
define('URL_INDEX', DIR_ROOT . 'index.php');

define('USER_ANONYMOUS', 0);
define('USER_ADMIN', 1);

include(DIR_CORE . 'functions.php');
include(DIR_CORE . 'functions-authorize.php');
include(DIR_CORE . 'functions-db.php');

session_start();
$db = db_connect();

$_app = [
	'action' => $_GET['action'] ?? '',
	'id' => (int)($_GET['id'] ?? ''),
];

$_page_view = [
	'page_title' => '',
	'_error' => [],
	'_message' => []
];

$module = $_GET['module'] ?? '';

$model_filename = '';

if ($module == '') $model_filename = 'home';
$model_filename = DIR_MODULES . "model-{$module}.php";

if (!file_exists($model_filename))
	$model_filename = DIR_MODULES . "model-error404.php";

include($model_filename);


include(DIR_VIEW . 'page-header.php');
include(DIR_VIEW . 'page-body.php');
if (URL_INDEX && empty(parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY))){
	include(DIR_VIEW . 'view-main.php');
	
}
if (isset($_page_view['view_filename']) && $_page_view['view_filename'] != '')
	include($_page_view['view_filename']);
include(DIR_VIEW . 'page-footer.php');

db_close($db);
?>
