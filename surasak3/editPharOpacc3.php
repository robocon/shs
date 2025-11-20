<?php 
include_once 'bootstrap.php';
if($_SESSION['sIdname']!=='krit')
{
    echo "Invalid";
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
$txdate = sprintf("%s", $_REQUEST['txdate']);
$hn = sprintf("%s", $_REQUEST['hn']);

$action = sprintf("%s", $_GET['action']);
if($action=='search'){
    $code = sprintf("%s", $_GET['code']);
    $sql = "SELECT * FROM druglst WHERE drugcode = '$code' ";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        $a = $q->fetch_assoc();
        ?>
        <table width="100%">
            <tr>
                <th>drugcode: </th>
                <td><?=$a['drugcode'];?></td>
                <th>tradname: </th>
                <td><?=$a['tradname'];?></td>
            </tr>
            <tr>
                <th>genname: </th>
                <td><?=$a['genname'];?></td>
                <th>unit: </th>
                <td><?=$a['unit'];?></td>
            </tr>
            <tr>
                <th>salepri: </th>
                <td><?=$a['salepri'];?></td>
                <th>part: </th>
                <td><?=$a['part'];?></td>
            </tr>
        </table>
        <?php
    }else{
        ?><p>ไม่พบข้อมูล</p><?php
    }
    exit;
}


if(empty($txdate) OR empty($hn))
{
    exit;
}

$bypass = '';
if($_REQUEST['bypass'] === 'yes')
{
    $where = "WHERE `date` LIKE '$txdate%' AND `hn` = '$hn'";
    $bypass = '&bypass=yes';
}
else
{
    $where = "WHERE `date` = '$txdate' AND `hn` = '$hn'";
}
$sql = "SELECT * FROM `phardep` $where ";
$q = $dbi->query($sql);
if($q->num_rows===0)
{
    echo "ไม่พบข้อมูล";
    exit;
}
?>
<fieldset>
    <legend>phardep</legend>
    <div>
        <table width="100%">
            <tr>
                <th>row_id</th>
                <th>date</th>
                <th>ptname</th>
                <th>hn</th>
                <th>ptright</th>
                <th>price</th>
                <th></th>
            </tr>
            <?php 
            $phardepRowId = array();
            while ($a = $q->fetch_assoc()) { 
                $phardepRowId[] = $a['row_id'];
                ?>
                <tr>
                    <td><a href="editPharOpacc4.php?date=<?=$a['datedr'];?>&hn=<?=$a['hn'];?>&type=dphardep" target="dphardep"><?=$a['row_id'];?></a></td>
                    <td><?=$a['date'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptright'];?></td>
                    <td><?=$a['price'];?></td>
                    <td><a href="editPharOpacc5.php?row_id=<?=$a['row_id'];?>&tablePart=phardep" target="editPage">แก้ไข</a><td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</fieldset>
<fieldset>
    <legend>drugrx</legend>
    <div>
        <?php 
        $test = implode(',', $phardepRowId);
        $sql = "SELECT * FROM `drugrx` WHERE `idno` IN ($test) ";
        $q = $dbi->query($sql);
        ?>
        <table width="100%">
            <tr>
                <th>row_id</th>
                <th>date</th>
                <th>hn</th>
                <th>drugcode</th>
                <th>tradname</th>
                <th>amount</th>
                <th>price</th>
                <th></th>
            </tr>
            <?php 
            while ($a = $q->fetch_assoc()) { 
                ?>
                <tr>
                    <td><?=$a['row_id'];?></td>
                    <td><?=$a['date'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><a href="javascript:void(0);" onclick="window.open('editPharOpacc3.php?action=search&code=<?=$a['drugcode'];?>','_newWindow','width=800,height=600')"><?=$a['drugcode'];?></a></td>
                    <td><?=$a['tradname'];?></td>
                    <td><?=$a['amount'];?></td>
                    <td><?=$a['price'];?></td>
                    <td><a href="editPharOpacc5.php?row_id=<?=$a['row_id'];?>&tablePart=drugrx" target="editPage">แก้ไข</a><td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</fieldset>