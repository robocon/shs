<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
	include 'pageNotFound.php';
	exit;
}