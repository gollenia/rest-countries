<?php

require_once('Regions.php');
require_once('Countries.php');


$lang = $_REQUEST['lang'] ?? 'en';
$region = $_REQUEST['region'] ?? 'world';

$countries = Countries::get($region, $lang);

header('Content-Type: application/json; charset=utf-8');

echo json_encode($countries);
