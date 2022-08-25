<?php 
$dbi = new mysqli('192.168.131.240','sm3db_user','sm3dbPassword','sm3db-utf8');
$date = strtotime("-1 month");
$thdate = (date('Y',$date)+543).date('-m-d',$date);
$sql = "SELECT * FROM `inhale_wound` WHERE `date` >= '$thdate' GROUP BY `hn`,`enddate` ORDER BY `startdate` DESC";
$q = $dbi->query($sql);
?>
<div><h3>พิมพ์ใบนัดทำแผลย้อนหลัง</h3></div>
<div>
<A HREF="..\nindex.htm">&lt;&lt;เมนู</A> | <a href="save_wound.php">ออกใบนัดทำแผล</a>
</div>
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
        <th>วันที่เริ่ม</th>
        <th>วันที่สิ้นสุด</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>แผล</th>
        <th>จำนวนวัน</th>
        <th>รายละเอียด</th>
     </tr>
<?php
while ($a = $q->fetch_assoc()) {
    $date = substr($a['date'],0,10);
    $hn = $a['hn'];
    $ptname = $a['yot'].$a['name'].' '.$a['sname'];
    $size_wound = $a['size_wound'];
    $total_day = $a['total_day'];
    $detail = $a['detail'];
    $startdate = $a['startdate'];
    $enddate = $a['enddate'];

    ?>
    <tr>
        <td><?=$startdate;?></td>
        <td><?=$enddate;?></td>
        <td><a href="print_save_wound.php?date=<?=$date;?>&hn=<?=$hn;?>" target="_blank"><?=$hn;?></a></td>
        <td><?=$ptname;?></td>
        <td><?=$size_wound;?></td>
        <td><?=$total_day;?></td>
        <td><?=$detail;?></td>
    </tr>
    <?php
}
?>
</table>
<div>

</div>