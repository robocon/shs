<?php 

include 'bootstrap.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มแก้ไข</title>
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
    <style>
        label:hover{
            cursor: pointer;
        }
    </style>
    <div class="w3-container w3-teal w3-bar">
        <h2 class="w3-bar-item" style="text-shadow: 2px 2px 2px #444;">ฟอร์มแก้ไขข้อมูล</h2>
    </div>

    <div class="w3-card-4">
        <table class="w3-table-all">
            <tr>
                <th>#</th>
                <th>วันที่</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>แก้ไข</th>
            </tr>
            <tr>
                <td>#</td>
                <td>วันที่</td>
                <td>HN</td>
                <td>ชื่อ-สกุล</td>
                <td><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            </tr>
        </table>
    </div>

</body>
</html>