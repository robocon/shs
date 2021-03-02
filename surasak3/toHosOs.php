<?php 
// include 'bootstrap.php';

// $db = Mysql::load();
// mysql_query("SET NAMES TIS-620");
// mysql_query("SET NAMES UTF-8");

$Conn = mysql_connect("localhost","root","12345678");
mysql_select_db("smdb", $Conn);
// mysql_query("SET NAMES TIS620", $Conn);

$sql = "SELECT `hn`,`idcard`,`yot`,`name`,`surname`,`dbirth`,
( CASE 
	WHEN `sex` = 'ช' THEN '1' 
	WHEN `sex` = 'ญ' THEN '2' 
	ELSE '3'
END ) AS `sex`,
`married`,
`education`,
`career` AS `occupation`,
`nation`,
`race`,
`religion`,
`father` AS `father_fname`,
'' AS `father_lname`,
`mother` AS `mother_fname`,
'' AS `mother_lname`,
`couple` AS `couple_fname`,
'' AS `couple_lname`,
`blood`,
`address`,
'' AS `road`,
'' AS `moo`,
`tambol`,
`ampur`,
`changwat`,
`ptffone`, 
`phone`, 
'' AS `email`,
`ptf` AS `contact_fname`,
'' AS `contact_lname`,
`ptfadd` AS `contact_relation`,
'' AS `contact_gender`,
'' AS `contact_house`,
'' AS `contact_moo`,
'' AS `contact_road`,
'' AS `contact_tambol`,
'' AS `contact_ampur`,
'' AS `contact_changwat`,
`ptffone` AS `contact_phone`,
'' AS `contact_mobilephone`,
'' AS `contact_email`,
`goup`, ## ประเภท
`camp`, ## สังกัด
`ptright1`, ## สิทธิการรักษา
`ptrightdetail`, ## ประเภทสิทธิ
`ptfmon`, ## เบิกจาก
`typearea` 
FROM `opcard` 
WHERE ( `idguard` NOT LIKE 'MX07%' AND `idguard` NOT LIKE 'MX04%' AND `idguard` NOT LIKE 'MX05%' ) 
AND ( `idguard2` NOT LIKE 'MX07%' AND `idguard2` NOT LIKE 'MX04%' AND `idguard` NOT LIKE 'MX05%' ) 
AND ( `name` <> 'ยุบประวัติ' AND `name` <> 'ยุบรวมประวัติ' ) 
ORDER BY `row_id` ASC ";

// $db->select($sql);
// $items = $db->get_items();

$q = mysql_query($sql);

?>
<p>ข้อมูลผู้ป่วย</p>
<table>
<?php
// foreach ($items as $key => $item) {
while($item = mysql_fetch_assoc($q)){ 
    ?>
    <tr>
        <td><?=$item['hn'];?></td>
        <td><?=$item['idcard'];?></td>
        <td><?=iconv("TIS-620","UTF-8",$item['yot']);?></td>
        <td><?=$item['name'];?></td>
        <td><?=$item['surname'];?></td>
        <td><?=$item['dbirth'];?></td>
        <td><?=$item['sex'];?></td>
        <td><?php 
        $marriage = '';
        if($item['married']=='โสด'){
            $marriage = '1';
        }elseif ($item['married']=='สมรส') {
            $marriage = '2';
        }elseif ($item['married']=='แยก') {
            $marriage = '3';
        }elseif ($item['married']=='หย่า') {
            $marriage = '4';
        }elseif ($item['married']=='หม้าย') {
            $marriage = '5';
        }elseif ($item['married']=='สมณะ') {
            $marriage = '6';
        }elseif ($item['married']=='อื่นๆ') {
            $marriage = '9';
        }
        echo $marriage;
        ?></td>
        <td><?=$item['education'];?></td>
        <td><?=str_replace('  ', ' ',$item['occupation']);?></td>
        <td><?=($item['nation']=='ไทย' ? '99' : $item['nation'] )?></td>
        <td><?=($item['race']=='ไทย' ? '99' : $item['race'] )?></td>
        <td><?php 
        $religion = '';
        if($item['religion']=='พุทธ'){
            $religion = '1';
        }elseif ($item['religion']=='อิสลาม') {
            $religion = '2';
        }elseif ($item['religion']=='คริสต์') {
            $religion = '3';
        }elseif ($item['religion']=='ฮินดู') {
            $religion = '4';
        }else{
            $religion = '7';
        }
        echo $religion;
        ?></td>
        <td><?=$item['father_fname'];?></td>
        <td><?=$item['father_lname'];?></td>
        <td><?=$item['mother_fname'];?></td>
        <td><?=$item['mother_lname'];?></td>
        <td><?=$item['couple_fname'];?></td>
        <td><?=$item['couple_lname'];?></td>
        <td><?php 
        $blood = '';
        if($item['blood']=='ไม่ทราบกรุ๊ปเลือด'){
            $blood = '1';
        }elseif ($item['blood']=='เอ') {
            $blood = '2';
        }elseif ($item['blood']=='บี') {
            $blood = '3';
        }elseif ($item['blood']=='เอบี') {
            $blood = '4';
        }elseif ($item['blood']=='โอ') {
            $blood = '5';
        }
        echo $blood;
        ?></td>
        <td><?=$item['address'];?></td>
        <td><?=$item['road'];?></td>
        <td><?=$item['moo'];?></td>
        <td><?=$item['tambol'];?></td>
        <td><?=$item['ampur'];?></td>
        <td><?=$item['changwat'];?></td>
        <td><?=$item['ptffone'];?></td>
        <td><?=$item['phone'];?></td>
        <td><?=$item['email'];?></td>
        <td><?=$item['contact_fname'];?></td>
        <td><?=$item['contact_lname'];?></td>
        <td><?=$item['contact_relation'];?></td>
        <td><?=$item['contact_gender'];?></td>
        <td><?=$item['contact_house'];?></td>
        <td><?=$item['contact_moo'];?></td>
        <td><?=$item['contact_road'];?></td>
        <td><?=$item['contact_tambol'];?></td>
        <td><?=$item['contact_ampur'];?></td>
        <td><?=$item['contact_changwat'];?></td>
        <td><?=$item['contact_phone'];?></td>
        <td><?=$item['contact_mobilephone'];?></td>
        <td><?=$item['contact_email'];?></td>
        <td><?=$item['goup'];?></td>
        <td><?=$item['camp'];?></td>
        <td><?=$item['ptright1'];?></td>
        <td><?=$item['ptrightdetail'];?></td>
        <td><?=$item['ptfmon'];?></td>
        <td><?=$item['typearea'];?></td>
    </tr>
    
    <?php
}
?>
</table>