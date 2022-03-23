<?php 
include_once 'bootstrap.php';
if($_SESSION['sIdname']!=='krit')
{
    echo "Invalid";
    exit;
}

// $dbi = new mysqli('192.168.131.250','remoteuser','',DB);
$dbi = new mysqli(HOST,USER,PASS,DB);
$part = $_REQUEST['part'];
$row_id = $_REQUEST['row_id'];

$section = $_REQUEST['section'];
$action = $_REQUEST['action'];
if($action==='save' && $section==='phardep'){

    $sql = "UPDATE `phardep` SET `price`='4410.00', 
    `paid`='0.00', 
    `essd`='1890.00', 
    `nessdy`='2520.00', 
    `nessdn`='0.00', 
    `dpy`='0.00', 
    `dpn`='0.00', 
    `dsy`='0.00', 
    `dsn`='0.00', 
    `tvn`='156'
    WHERE `row_id`='10' ;";
    $q = $dbi->query($sql);
    dump($q);
    exit;
}

if($part==='phardep' && !empty($row_id))
{
    $sql = "SELECT * FROM `phardep` WHERE `row_id` = '$row_id' ";
    $q = $dbi->query($sql);
    if($q->num_rows === 0)
    {
        echo "Invalid parameter";
        exit;
    }
    $it = $q->fetch_assoc();
    ?>
    <form action="editPharOpacc5.php" method="post">
    <table width="100%">
        <tr valign="top">
            <td>hn - ptname</td>
            <td><?=$it['hn'];?><br><?=$it['ptname'];?></td>
            <td>date</td>
            <td><input type="text" name="date" id="date" value="<?=$it['date'];?>"></td>
        </tr>
        <tr>
            <td>price</td>
            <td><input type="text" name="price" id="price" value="<?=$it['price'];?>"></td>
            <td>paid</td>
            <td><input type="text" name="paid" id="paid" value="<?=$it['paid'];?>"></td>
        </tr>
        <tr>
            <td>essd</td>
            <td><input type="text" name="essd" id="essd" value="<?=$it['essd'];?>"></td>
            <td>nessdy</td>
            <td><input type="text" name="nessdy" id="nessdy" value="<?=$it['nessdy'];?>"></td>
        </tr>
        <tr>
            <td>nessdn</td>
            <td><input type="text" name="nessdn" id="nessdn" value="<?=$it['nessdn'];?>"></td>
            <td>dpy</td>
            <td><input type="text" name="dpy" id="dpy" value="<?=$it['dpy'];?>"></td>
        </tr>
        <tr>
            <td>dpn</td>
            <td><input type="text" name="dpn" id="dpn" value="<?=$it['dpn'];?>"></td>
            <td>dsy</td>
            <td><input type="text" name="dsy" id="dsy" value="<?=$it['dsy'];?>"></td>
        </tr>
        <tr>
            <td>dsn</td>
            <td><input type="text" name="dsn" id="dsn" value="<?=$it['dsn'];?>"></td>
            <td>tvn</td>
            <td><input type="text" name="tvn" id="tvn" value="<?=$it['tvn'];?>"></td>
        </tr>
        <tr>
            <td rowspan="4" style="text-align: center;">
                <button type="submit">บันทึกข้อมุล</button>
                <input type="hidden" name="section" value="phardep">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="row_id" value="<?=$it['row_id'];?>">
            </td>
        </tr>
    </table>
    </form>
    <?php

}