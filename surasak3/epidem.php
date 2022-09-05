<?php 
session_start();
header("Location: http://192.168.129.143/epidem/epidem.php?idname=".$_SESSION['sIdname']);