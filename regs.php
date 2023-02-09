<?php

require_once('Regions.php');


$lang = $_REQUEST['lang'] ?? 'en';

$regions = Regions::get($lang);

header('Content-Type: application/json; charset=utf-8');

echo json_encode($regions);
