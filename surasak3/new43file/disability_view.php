<?php 
session_start();
$db2 = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );


?>
<style>
/* ตาราง */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<div>
    <div style="width: 50%; float: left;">
        <div>
            <h3>DISABILITY</h3>
        </div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>HN</th>
                <th>ชื่อสกุล</th>
                <th>เลขที่บัตรปชช.</th>
                <th>รหัสความพิการ</th>
                <th>วันที่ปรับปรุงข้อมูล</th>
            </tr>
            <?php 
            $sql = "SELECT CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`idcard`, a.*  
            FROM `DISABILITY` AS a 
            LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` ";
            $q = mysql_query($sql) or die(mysql_error());
            $i = 1;
            while ($item = mysql_fetch_assoc($q)) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['idcard'];?></td>
                    <td><?=$item['DISABTYPE'];?></td>
                    <td><?=$item['last_update'];?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
    </div>
    <div style="width: 50%; float: left;">
        <div>
            <h3>ICF</h3>
        </div>
        <table class="chk_table ">
            <tr>
                <th>#</th>
                <th>HN</th>
                <th>ชื่อสกุล</th>
                <th>เลขที่บัตรปชช.</th>
                <th>รหัสสภาวะสุขภาพ</th>
                <th>วันที่ปรับปรุงข้อมูล</th>
            </tr>
            <?php 
            $sql = "SELECT CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`idcard`, a.*  
            FROM `ICF` AS a 
            LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` ";
            $q = mysql_query($sql) or die(mysql_error());
            $i = 1;
            while ($item = mysql_fetch_assoc($q)) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['idcard'];?></td>
                    <td><?=$item['ICF'];?></td>
                    <td><?=$item['last_update'];?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
    </div>
</div>