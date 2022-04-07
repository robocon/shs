<?php 
include_once 'bootstrap.php';
if($_SESSION['sIdname']!=='krit')
{
    echo "Invalid";
    exit;
}

$dbi = new mysqli('192.168.131.250','remoteuser','',DB);
// $dbi = new mysqli(HOST,USER,PASS,DB);
$txdate = $_REQUEST['txdate'];
$hn = $_REQUEST['hn'];

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
        <table>
            <tr>
                <th>row_id</th>
                <th>date</th>
                <th>ptname</th>
                <th>hn</th>
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
                    <td><?=$a['price'];?></td>
                    <td><a href="editPharOpacc5.php?row_id=<?=$a['row_id'];?>&part=phardep" target="editPage">แก้ไข</a><td>
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
        <table>
            <tr>
                <th>row_id</th>
                <th>date</th>
                <th>hn</th>
                <th>drugcode</th>
                <th>amount</th>
                <th>price</th>
                <th></th>
            </tr>
            <?php 
            while ($a = $q->fetch_assoc()) { 
                ?>
                <tr>
                    <td><a href="javascript:void(0);"><?=$a['row_id'];?></a></td>
                    <td><?=$a['date'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['drugcode'];?></td>
                    <td><?=$a['amount'];?></td>
                    <td><?=$a['price'];?></td>
                    <td><a href="editPharOpacc5.php?row_id=<?=$a['row_id'];?>&part=drugrx" target="editPage">แก้ไข</a><td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</fieldset>