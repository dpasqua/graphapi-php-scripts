<?php
session_start();
header("Content-type: text/html; charset=UTF-8");

// datetimezone
date_default_timezone_set('America/Sao_Paulo');

// habilita erros do php
ini_set('display_errors', true);

// autoloader gerado pelo composer
require_once __DIR__ . "/vendor/autoload.php";

define('APP_ID', '');
define('APP_SECRET', '');
define('APP_VERSION', '');

// siteurl
$siteUrl = "http://";

// instancia do facebook
$fb = new Facebook\Facebook([
	'app_id'     => APP_ID,
	'app_secret' => APP_SECRET,
    'default_graph_version' => APP_VERSION
]);
