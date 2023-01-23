<?php 
include_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

dump($_REQUEST);

$drug_ids = $_REQUEST['drug_id'];

dump($drug_ids);