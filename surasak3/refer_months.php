<?php
include 'bootstrap.php';

$def_month_start = ( date('Y')+543 ).'-'.date('m');

$action = input_post('action');
$month_start = input_post('month_start', $def_month_start);
$month_end = input_post('month_end', $def_month_start);

?>
<style type="text/css">
@media print{
    #userForm{
        display: none;
    }
}
table {
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
    padding: 2px;
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt; หน้าหลักรพ.</a>
</div>
<h3>รายงานข้อมูลผู้ป่วยใน Refer ตามเดือน</h3>
<form action="refer_months.php" method="post" id="userForm">
    <div>
        เลือกเดือน <input type="text" name="month_start" value="<?=$month_start;?>">
        ถึงเดือน <input type="text" name="month_end" value="<?=$month_end;?>">
        <br>
        <span>ตัวอย่าง รูปแบบการใส่เดือน เช่น 2560-02</span>
    </div>
    <div>
        <button type="submit">ตกลง</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>
<?php
if ( $action === 'show' ) {

    $sections = array(
		'opd' => 'OPD', 
		'opd_obg' => 'สูติ', 
		'opd_eye' => 'ห้องตา', 
		'ER' => 'ห้องฉุกเฉิน',
		'Ward42' => 'Ward รวม',
		'Ward43' => 'Ward สูติ',
		'Ward44' => 'Ward ICU',
		'Ward45' => 'Ward พิเศษ',
	);

    $db = Mysql::load();
    $sql = "SELECT *, CONCAT(`name`,' ',`sname`) AS `ptname` 
    FROM `refer` 
    WHERE `an` != '' 
    AND ( `dateopd` >= '$month_start' AND `dateopd` <= '$month_end' ) ";
    $db->select($sql);
    $items = $db->get_items();
    if( count($items) > 0 ){
        ?>
        <table>
            <thead>
                <tr>
                    <th>เลขRefer</th>
                    <th>AN</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>วันที่ Refer</th>
                    <th>จาก</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($items as $key => $item) {
                
                $ward = $item['ward'];

                if( preg_match('/^Ward(\d{2,})/', $ward, $match) > 0 ){
                    $ward_key = $match['0'];
                    $by = $sections[$ward_key];
                }else{
                    switch($ward){
                        case "opd" : $by = "ห้องตรวจโรค"; break;  
                        case "opd_eye" : $by = "จักษุ"; break;
                        case "opd_obg" : $by = "สูติ"; break;
                        case "ER" : $by = "ER"; break;
                    }
                }

                $refer_no = $item['refer_runno'];
                $an = $item['an'];
                $hn = $item['hn'];
                $ptname = $item['ptname'];
                $dateopd = $item['dateopd'];
                
                ?>
                <tr>
                    <td><a href="ward_follow_refer_detail.php?id=<?=urlencode($refer_no);?>" target="_blank"><?=$refer_no;?></a></td>
                    <td><?=$an;?></td>
                    <td><?=$hn;?></td>
                    <td><?=$ptname;?></td>
                    <td><?=$dateopd;?></td>
                    <td><?=$by;?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }else{
        ?>
        <p>ไม่พบข้อมูลที่ต้องการค้นหา</p>
        <?php
    }
}

