#!/usr/bin/php
<?php 

$conn = new mysqli("192.168.1.2", "remoteuser", "", "smdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$handle = fopen("C:\\Users\\roboc\\OneDrive\\Documents\\Lab-Offline.csv", "w");

$row = array('รหัสแลป','รายละเอียด','ราคาเต็ม','เบิกได้','เบิกไม่ได้','NOTE','CODELAB','ชื่อ OUTLAB','LABPART');
fputcsv($handle, $row);

$sql = "SELECT `code`,`detail`,`price`,`yprice`,`nprice`,`note`,`codelab`,`outlab_name`,`labpart` FROM `labcare` WHERE `depart` = 'PATHO' AND `part` = 'LAB' ORDER BY `CODE` ASC ";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 

        fputcsv($handle, $row);

    }
}

fclose($handle);