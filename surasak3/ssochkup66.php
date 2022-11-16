<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

?>
<table>
    <tr>
        <td>#</td>
        <td>date</td>
        <td>HN</td>
        <td>name</td>
        <td>LAB</td>
        <td>XRAY</td>
    </tr>
<?php
$i = 1;
$q = $dbi->query("SELECT * FROM `depart` WHERE `date` LIKE '2565-10%' AND `cashok` = 'SSOCHKUP66' AND (`depart`='XRAY' OR `depart`='PATHO') GROUP BY `hn`,`depart` ORDER BY `hn` ");
while ($a = $q->fetch_assoc()) {
    ?>
    <tr>
        <td><?=$i;?></td>
        <td><?=$a['date'];?></td>
        <td><?=$a['hn'];?></td>
        <td><?=$a['ptname'];?></td>
        <td><?=$a['depart'];?></td>
        <td><?=$a['price'];?></td>
    </tr>
    <?php
    $i++;
}
?>
</table>