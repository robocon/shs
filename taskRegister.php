#!/usr/bin/php
<?php 

$conn = new mysqli("192.168.1.2", "remoteuser", "", "smdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$handle = fopen("D:\\Opcard-Offline.csv", "w");

$row = array('เลขที่บัตรประชาชน','HN','ชื่อ-สกุล','สิทธิ์','สิทธิ์ที่ใช้ล่าสุด','ที่อยู่');
fputcsv($handle, $row);

$sql = "SELECT `idcard`,`hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`ptright1`,`ptright`,CONCAT(`address`,' ',`tambol`,' อ.',`ampur`,' ',`changwat`) AS `address` FROM `opcard`";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 

        fputcsv($handle, $row);

    }
}

fclose($handle);