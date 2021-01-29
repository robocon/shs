<?php 
include('phpqrcode/qrlib.php');
$hn = $_GET['hn'];
QRcode::png($hn);