<?php 
include_once 'bootstrap.php';
include_once 'includes/JSON.php';

if($_SESSION['sIdname']!=='krit')
{
    echo "Invalid";
    exit;
}

$json = new Services_JSON();
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
$part = $_REQUEST['part'];
$row_id = $_REQUEST['row_id'];

$section = $_REQUEST['section'];
$action = $_REQUEST['action'];
if($action==='save' && $section==='phardep')
{

    $price = $_POST['price'];
    $paid = $_POST['paid'];
    $essd = $_POST['essd'];
    $nessdy = $_POST['nessdy'];
    $nessdn = $_POST['nessdn'];
    $dpy = $_POST['dpy'];
    $dpn = $_POST['dpn'];
    $dsy = $_POST['dsy'];
    $dsn = $_POST['dsn'];
    $date = $_POST['date'];
    $datedr = $_POST['datedr'];
    $row_id = $_POST['row_id'];

    $sql = "UPDATE `phardep` SET `date`='$date', 
    `datedr`='$datedr', 
    `price`='$price', 
    `paid`='$paid', 
    `essd`='$essd', 
    `nessdy`='$nessdy', 
    `nessdn`='$nessdn', 
    `dpy`='$dpy', 
    `dpn`='$dpn', 
    `dsy`='$dsy', 
    `dsn`='$dsn'
    WHERE `row_id`='$row_id' ;";
    $q = $dbi->query($sql);
    if(!empty($mysqli->error))
    {
        echo $mysqli->error;
    }
    else
    {
        echo "บันทึกข้อมูลเรียบร้อย";
    }
    
}
elseif($action==='save' && $section==='drugrx')
{

    $price = $_POST['price'];
    $date = $_POST['date'];
    $datedr = $_POST['datedr'];
    $part = $_POST['part'];
    $row_id = $_POST['row_id'];

    $sql = "UPDATE `drugrx` SET `date`='$date', 
    `datedr`='$datedr', 
    `price`='$price', 
    `part`='$part' 
    WHERE `row_id`='$row_id' ;";
    $q = $dbi->query($sql);
    if(!empty($mysqli->error))
    {
        echo $mysqli->error;
    }
    else
    {
        echo "บันทึกข้อมูลเรียบร้อย";
    }
    
}
elseif($action==='save' && $section==='dphardep')
{
    $date = $_POST['date'];
    $price = $_POST['price'];
    $essd = $_POST['essd'];
    $row_id = $_POST['row_id'];
    $tvn = $_POST['tvn'];

    $sql = "UPDATE `dphardep` SET `date`='$date', 
    `price`='$price', 
    `essd`='$essd', 
    `tvn`='$tvn'
    WHERE `row_id`='$row_id' ;";
    $q = $dbi->query($sql);
    if(!empty($mysqli->error))
    {
        echo $mysqli->error;
    }
    else
    {
        echo "บันทึกข้อมูลเรียบร้อย";
    }
    
}
elseif($action==='save' && $section==='ddrugrx')
{
    $date = $_POST['date'];
    $price = $_POST['price'];
    $salepri = $_POST['salepri'];
    $row_id = $_POST['row_id'];

    $sql = "UPDATE `ddrugrx` SET `date`='$date', 
    `price`='$price', 
    `salepri`='$salepri' 
    WHERE `row_id`='$row_id' ;";
    $q = $dbi->query($sql);
    if(!empty($mysqli->error))
    {
        echo $mysqli->error;
    }
    else
    {
        echo "บันทึกข้อมูลเรียบร้อย";
    }
    
}
elseif ($action === 'searchDrug') 
{

    $code = $_REQUEST['code'];
    $sql = "SELECT * FROM `druglst` WHERE `drugcode` = '$code' ";
    $q = $dbi->query($sql);
    $item = $q->fetch_assoc();
    
    $data = array( 
    'drugcode' => $item['drugcode'],
    'tradname' => $item['tradname'],
    'salepri' => $item['salepri'],
    );

    echo $json->encode($data);
    exit;
}


/**
 * ส่วนของฟอร์มแก้ไข
 */
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
            <td>phardep ===> </td>
            <td>HN: <?=$it['hn'];?> ชื่อ-สกุล: <?=$it['ptname'];?></td>
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
            <td colspan="4" style="text-align: center;">
                <button type="submit">บันทึกข้อมุล</button>
                <input type="hidden" name="section" value="phardep">
                <input type="hidden" name="part" value="phardep">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="row_id" value="<?=$it['row_id'];?>">
            </td>
        </tr>
    </table>
    </form>
    <?php

}elseif($part==='drugrx' && !empty($row_id)){

    $sql = "SELECT * FROM `drugrx` WHERE `row_id` = '$row_id' ";
    $q = $dbi->query($sql);
    if($q->num_rows === 0)
    {
        echo "Invalid parameter";
        exit;
    }
    $it = $q->fetch_assoc();

    ?>
    <form action="editPharOpacc5.php" method="post">
    <table>
        <tr>
            <td>drugrx ===> hn</td>
            <td><?=$it['hn'];?></td>
            <td>date</td>
            <td><input type="text" name="date" id="date" value="<?=$it['date'];?>"></td>
        </tr>
        <tr>
            <td>drugcode</td>
            <td>
                <input type="text" name="drugcode" id="drugcode" value="<?=$it['drugcode'];?>">
                <button type="button" onclick="getDrugCode()">code</button>
            </td>
            <td>tradname</td>
            <td><input type="text" name="tradname" id="tradname" value="<?=$it['tradname'];?>"></td>
        </tr>
        <tr>
            <td>amount</td>
            <td><input type="text" name="amount" id="amount" value="<?=$it['amount'];?>"></td>
            <td>price</td>
            <td><input type="text" name="price" id="price" value="<?=$it['price'];?>"></td>
        </tr>
        <tr>
            <td>slcode</td>
            <td><input type="text" name="slcode" id="slcode" value="<?=$it['slcode'];?>"></td>
            <td>part</td>
            <td><input type="text" name="part" id="part" value="<?=$it['part'];?>"></td>
        </tr>
        <tr>
            <td>datedr</td>
            <td><input type="text" name="datedr" id="datedr" value="<?=$it['datedr'];?>"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">
                <button type="submit">บันทึกข้อมุล</button>
                <input type="hidden" name="section" value="drugrx">
                <input type="hidden" name="part" value="drugrx">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="row_id" value="<?=$it['row_id'];?>">
            </td>
        </tr>
    </table>
    </form>
    <script>
        function xmlHttpGET(url, functionName)
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {
                        // Success!
                        functionName(this);
                    } else {
                        // Error :(
                    }
                }
            };
            xhttp.open('GET', url, true);
            xhttp.send();
            xhttp = null;
        }
        
        async function getDrugCode(){

            var drugCode = document.getElementById('drugcode').value;

            return await new Promise(function(resolve){
                xmlHttpGET("editPharOpacc5.php?action=searchDrug&code="+drugCode, function(xhttp){
                    // console.log(xhttp.responseText);
                    var data = JSON.parse(xhttp.responseText);
                    
                    document.getElementById('tradname').value = data.tradname;
                    document.getElementById('price').value = data.salepri;
                    document.getElementById('drugcode').value = data.drugcode;

                })
                resolve();
            })
        }
    </script>
    <?php
}elseif($part==='dphardep' && !empty($row_id)){ 

    $sql = "SELECT * FROM `dphardep` WHERE `row_id` = '$row_id' ";
    $q = $dbi->query($sql);
    if($q->num_rows === 0)
    {
        echo "Invalid parameter";
        exit;
    }
    $a = $q->fetch_assoc();

    ?>
    <form action="editPharOpacc5.php" method="post">
        <table>
            <tr>
                <td>dphardep ===> </td>
                <td>
                    HN: <?=$a['hn'];?> ชื่อ-สกุล: <?=$a['ptname'];?>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>row_id</td>
                <td><?=$a['row_id'];?></td>
                <td>date</td>
                <td><input type="text" name="date" id="date" value="<?=$a['date'];?>"></td>
            </tr>
            <tr>
                <td>price</td>
                <td><input type="text" name="price" id="price" value="<?=$a['price'];?>"></td>
                <td>essd</td>
                <td><input type="text" name="essd" id="essd" value="<?=$a['essd'];?>"></td>
            </tr>
            <tr>
                <td>tvn</td>
                <td><input type="text" name="price" id="price" value="<?=$a['price'];?>"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="4">
                    <button type="submit">บันทึก</button>
                    <input type="hidden" name="section" value="dphardep">
                    <input type="hidden" name="part" value="dphardep">
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="row_id" value="<?=$a['row_id'];?>">
                </td>
            </tr>
        </table>
    </form>
    <?php
}elseif($part==='ddrugrx' && !empty($row_id)){ 

    $sql = "SELECT * FROM `ddrugrx` WHERE `row_id` = '$row_id' ";
    $q = $dbi->query($sql);
    if($q->num_rows === 0)
    {
        echo "Invalid parameter";
        exit;
    }
    $a = $q->fetch_assoc();
    ?>
    <form action="editPharOpacc5.php" method="post">
        <p>ddrugrx ===> row_id: <?=$a['row_id'];?> HN: <?=$a['hn'];?></p>
        <table>
            <tr>
                <td>date</td>
                <td><input type="text" name="date" id="date" value="<?=$a['date'];?>"></td>
                <td>drugcode</td>
                <td><input type="text" name="drugcode" id="drugcode" value="<?=$a['drugcode'];?>"></td>
            </tr>
            <tr>
                <td>salepri</td>
                <td><input type="text" name="salepri" id="salepri" value="<?=$a['salepri'];?>"></td>
                <td>amount</td>
                <td><input type="text" name="amount" id="amount" value="<?=$a['amount'];?>"></td>
            </tr>
            <tr>
                <td>price</td>
                <td><input type="text" name="price" id="price" value="<?=$a['price'];?>"></td>
                <td>part</td>
                <td><input type="text" name="part" id="part" value="<?=$a['part'];?>"></td>
            </tr>
            <tr>
                <td rowspan="4">
                    <button type="submit">บันทึก</button>
                    <input type="hidden" name="section" value="ddrugrx">
                    <input type="hidden" name="part" value="ddrugrx">
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="row_id" value="<?=$a['row_id'];?>">
                </td>
            </tr>
        </table>
    </form>
    <?php
}