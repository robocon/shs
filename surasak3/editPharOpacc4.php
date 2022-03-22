<?php 
include_once 'bootstrap.php';
if($_SESSION['sIdname']!=='krit')
{
    echo "Invalid";
    exit;
}

$dbi = new mysqli('192.168.131.250','remoteuser','',DB);
$date = $_REQUEST['date'];
$hn = $_REQUEST['hn'];
if(empty($date) OR empty($hn))
{
    exit;
}

$type = $_REQUEST['type'];
if($type === 'dphardep')
{
    $sql = "SELECT * FROM `dphardep` WHERE `date` = '$date' AND `hn` = '$hn'";
    $q = $dbi->query($sql);
    if($q->num_rows > 0)
    {
    ?>
    <fieldset>
        <legend>dphardep</legend>
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
                $dPhardepRowId = array();
                while ($a = $q->fetch_assoc()) { 
                    $dPhardepRowId[] = $a['row_id'];
                    ?>
                    <tr>
                        <td><?=$a['row_id'];?></td>
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
    <?php
    }

    $test = implode(',', $dPhardepRowId);
    $sql = "SELECT * FROM `ddrugrx` WHERE `idno` IN ($test) ";
    $q = $dbi->query($sql);
    ?>
    <fieldset>
        <legend>ddrugrx</legend>
        <div>
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
                        <td><?=$a['row_id'];?></td>
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
    <?php
}

