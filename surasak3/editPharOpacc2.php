<?php 
include_once 'bootstrap.php';
if($_SESSION['sIdname']!=='krit')
{
    echo "Invalid";
    exit;
}
?>
<form action="editPharOpacc2.php" method="post">
    <div>
        วันที่: <input type="text" name="date" id="date" value="<?=$_REQUEST['date'];?>"> * 2563-09-13
    </div>
    <div>
        HN: <input type="text" name="hn" id="hn" value="<?=$_REQUEST['hn'];?>">
    </div>
    <div>
        <button type="submit">search</button>
    </div>
</form>
<?php 
if($_REQUEST['hn']){
    
    $dbi = new mysqli(HOST,USER,PASS,DB);
    $dbi->query("SET NAMES UTF8");
    $date = $_REQUEST['date'];
    $hn = $_REQUEST['hn'];

    $sql = "SELECT * FROM `opacc` WHERE `date` LIKE '$date%' AND `hn` = '$hn' AND `depart` = 'PHAR' ";
    $qOP = $dbi->query($sql);
    if($qOP->num_rows>0)
    {
        ?>
        <table width="100%">
            <tr>
                <th>row_id</th>
                <th>date</th>
                <th>hn</th>
                <th>vn</th>
                <th>credit</th>
                <th>price</th>
                <th>essd</th>
                <th>nessdy</th>
                <th>nessdn</th>
                <th>dpy</th>
                <th>dpn</th>
                <th>dsy</th>
                <th>dsn</th>
                <th></th>
            </tr>
        <?php
        while ($a = $qOP->fetch_assoc()) {
            ?>
            <tr>
                <td><a href="editPharOpacc3.php?txdate=<?=$a['txdate'];?>&hn=<?=$a['hn'];?>" target="phardep"><?=$a['row_id'];?></a></td>
                <td><?=$a['date'];?></td>
                <td><?=$a['hn'];?></td>
                <td><?=$a['vn'];?></td>
                <td><?=$a['credit'];?></td>
                <td><?=$a['price'];?></td>
                <td><?=$a['essd'];?></td>
                <td><?=$a['nessdy'];?></td>
                <td><?=$a['nessdn'];?></td>
                <td><?=$a['dpy'];?></td>
                <td><?=$a['dpn'];?></td>
                <td><?=$a['dsy'];?></td>
                <td><?=$a['dsn'];?></td>
                <td><a href="edit_opacc5.php?type=opacc&id=<?=$a['row_id'];?>" target="editPage">แก้ไข</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }
    else
    {
        echo 'ไม่มีข้อมูลใน OPACC <a href="editPharOpacc3.php?bypass=yes&txdate='.$date.'&hn='.$hn.'" target="phardep">แสดงข้อมูล phardep</a>';
    }
}