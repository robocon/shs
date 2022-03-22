<?php 
include_once 'bootstrap.php';
$dbi = new mysqli('192.168.131.250','remoteuser','',DB);
$txdate = $_REQUEST['txdate'];
$hn = $_REQUEST['hn'];
if($_REQUEST['bypass'] === 'yes')
{
    $where = "WHERE `date` LIKE '$txdate%' AND `hn` = '$hn'";
}
else
{
    $where = "WHERE `date` = '$txdate' AND `hn` = '$hn'";
}

?>
<fieldset>
    <legend>phardep</legend>
    <div>
        <?php 
        $sql = "SELECT * FROM `phardep` $where ";
        $q = $dbi->query($sql);
        ?>
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
                    <td><a href="javascript:void(0);"><?=$a['row_id'];?></a></td>
                    <td><?=$a['date'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['price'];?></td>
                    <td><a href="javascript:void(0)">·°È‰¢</a><td>
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
                    <td><a href="javascript:void(0)">·°È‰¢</a><td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</fieldset>
<script>
    window.onload = function(){
        // document.getElementById('dphardep').attributes.src = "";

        document.querySelector('iframe[name="dphardep"]').src = "editPharOpacc4.php?date=<?=$txdate;?>&hn=<?=$hn;?>";


    }
</script>