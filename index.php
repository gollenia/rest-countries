<?php

phpinfo();
require_once('Countries.php');

var_dump($_REQUEST);

$lang = $_REQUEST['lang'] ?? 'en';
$region = $_REQUEST['region'] ?? 'world';


