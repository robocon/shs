<?php 

include 'Connections/config.php';
include 'Connections/all_function.php';

$hn = $_GET['hn'];
$sql = "SELECT SUBSTRING(`thidate`,1,10) AS `thidate`,`vn`,`diag`,`doctor`,`clinic`,`toborow` 
FROM `opday` 
WHERE `hn` = '$hn' 
AND `thidate` >= '2561-01-01 00:00:00' 
ORDER BY `thidate` DESC";
$q = mysql_query($sql);
if ( mysql_num_rows($q) > 0 ) {
    ?>
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
            <th>วันที่</th>
            <th>VN</th>
            <th>แพทย์</th>
            <th>Diag</th>
            <th>คลินิก</th>
            <th>มาเพื่อ</th>
        </tr>
        <?php
        while ($item = mysql_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?=$item['thidate'];?></td>
                <td><a href="javascript:void(0);" onclick="opener.document.sel.VN.value=<?=$item['vn'];?>;self.close();"><?=$item['vn'];?></a></td>
                <td><?=$item['doctor'];?></td>
                <td><?=$item['diag'];?></td>
                <td><?=$item['clinic'];?></td>
                <td><?=$item['toborow'];?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else{
    ?><p>ไม่พบข้อมูล การมาใช้บริการ</p><?php
}

