<?php 
include 'bootstrap.php';

if(empty($_REQUEST['code']) OR $_SESSION['smenucode']!=='ADM')
{
    echo "Invalid";
    exit;
}

$code = $_REQUEST['code'];
$dbi = new mysqli('192.168.131.250','remoteuser','',DB);
$q = $dbi->query("SELECT * FROM `labcare` WHERE `code` = '$code' ");
$item = $q->fetch_assoc();
?>
<style>
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }
    </style>
<table class="chk_table">
    <tr>
        <th>row_id</th>
        <th>depart</th>
        <th>part</th>
        <th>code</th>
        <th>price</th>
        <th>codebak</th>
        <th>codex</th>
        <th>detail</th>
    </tr>
    <tr>
        <td><?=$item['row_id'];?></td>
        <td><?=$item['depart'];?></td>
        <td><?=$item['part'];?></td>
        <td><?=$item['code'];?></td>
        <td><?=$item['price'];?></td>
        <td><?=$item['codebak'];?></td>
        <td><?=$item['codex'];?></td>
        <td><?=$item['detail'];?></td>
    </tr>
</table>