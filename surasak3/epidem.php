<?php 
session_start();
require_once 'includes/config.php';

header("Location: ".NOTIFY_HOST."/epidem/epidem.php?idname=".$_SESSION['sIdname']);