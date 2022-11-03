<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);

$sql = "SELECT * FROM `accrued` WHERE ( `date` >= '2563-10-01 00:00:00' AND `date` <= '2564-09-30 23:59:59' ) AND `status_pay` = 'y' ";
$q = $dbi->query($sql);

?>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 16px;
    }
    .chk_table{
        border-collapse: collapse;
    }
    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
    }
</style>
<h1>สถานะการชำระจากค้างจ่าย ปีงบ64 (ตั้งแต่ 01 ต.ค. 2563 ถึง 30 ก.ย. 2564)</h1>
<table class="chk_table">
    <tr style="background-color: #ADDFFF;">
        <th>ลำดับ</th>
        <th>วันที่รับบริการ</th>
        <th>วันที่บันทึกข้อมูล</th>
        <th>VN</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>รายการ</th>
        <th>สิทธิ</th>
        <th>เลขที่ใบเสร็จ</th>
        <th>วันที่มาจ่าย</th>
        <th>จำนวนเงิน</th>
    </tr>
<?php 
$i = 1;
while ($item = $q->fetch_assoc()) { 

    $hn = $item['hn'];

    $sql_opdcard = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' LIMIT 1; ";
    $q_opdcard = $dbi->query($sql_opdcard);
    $opdcard = $q_opdcard->fetch_assoc();

    ?>
    <tr>
        <td><?=$i;?></td>
        <td><?=$item['txdate'];?></td>
        <td><?=$item['date'];?></td>
        <td><?=$item['vn'];?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$opdcard['ptname'];?></td>
        <td><?=$item['detail'];?></td>
        <td><?=$item['ptright'];?></td>
        <td><?=$item['billno'];?></td>
        <td><?=$item['pay_date'];?></td>
        <td><?=$item['price'];?></td>
    </tr>
    <?php
    $i++;
}

?>
</table>