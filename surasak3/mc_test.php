<?php

$booking = array(
'59-7927' => 1, 
'59-7928' => 1, 
'59-7920' => 1, 
'59-7936' => 1, 
'59-8112' => 1, 
'59-8116' => 1, 
'59-8383' => 1, 
'56-518' => 1, 
'59-8719' => 1, 
'59-8489' => 1, 
'59-8841' => 1, 
'59-8916' => 1, 
'59-9170' => 1, 
'59-9307' => 1, 
'59-9649' => 1, 
'59-9750' => 1, 
'59-9795' => 1, 
'59-9808' => 1, 
'59-9844' => 1, 
'59-9847' => 1, 
'59-9103' => 1, 
'59-10053' => 1, 
'59-9823' => 1, 
'59-9768' => 1, 
'59-10142' => 1, 
'59-10231' => 1, 
'59-10248' => 1, 
'59-10319' => 1, 
'59-10253' => 1, 
'59-10369' => 1, 

'59-10427' => 1, 
'59-10508' => 1, 
'59-9758' => 1, 
'59-10518' => 1, 
'59-10544' => 1, 
'59-10549' => 1, 
'59-10666' => 1, 
'59-10655' => 1, 
'59-10665' => 1, 
'59-3253' => 1, 
'59-10691' => 1, 
'59-10694' => 1, 
'59-10085' => 1, 
'59-10739' => 1, 
'59-10793' => 1, 
'59-10695' => 1, 
'59-10807' => 1, 
'58-9247' => 1, 
'60-66' => 1, 
'60-85' => 1, 
'60-98' => 1, 
'60-101' => 1, 
'60-124' => 1, 
'60-185' => 1, 
'58-1343' => 1, 
'60-248' => 1, 
'59-345' => 1, 
'60-276' => 1, 
'60-292' => 1, 
'58-1980' => 1, 
'60-321' => 1, 

'60-352' => 1, 
'60-355' => 1, 
'60-402' => 1, 
'59-9660' => 1, 
'59-10806' => 1, 
'56-4847' => 1, 
'60-126' => 1, 
'50-11754' => 1, 
'56-2564' => 1, 
'60-506' => 1, 
'60-70' => 1, 
'60-540' => 1, 
'60-611' => 1, 
'60-606' => 1, 
'60-605' => 1, 
'60-499' => 1, 
'60-602' => 1, 
'59-10497' => 1, 
'60-647' => 1, 
'60-644' => 1, 
'60-687' => 1, 
'60-691' => 1, 
'54-8289' => 1, 
'60-719' => 1, 
'54-1361' => 1, 
'60-748' => 1, 
'60-744' => 1, 
'60-755' => 1, 
'60-657' => 1, 
'60-658' => 1, 
'49-14415' => 1, 
'60-68' => 1, 

'60-838' => 1, 
'60-849' => 1, 
'60-856' => 1, 
'54-4211' => 1, 
'60-897' => 1, 
'60-929' => 1, 
);

include 'bootstrap.php';

$db = Mysql::load();

$now = ( date('Y') + 543 ).'-'.date('m-y');

$sql = "SELECT a.`thidate`,a.`hn`,a.`ptname`,a.`vn`,a.`toborow`,
b.`idcard`, 
c.`vn` AS `opd_vn`,c.`dx_mc_soldier`,c.`rule`
FROM `opday` AS a
LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn` 
LEFT JOIN `opd` AS c ON c.`thdatehn` = a.`thdatehn` 
WHERE a.`thidate` >= '2559-09-01' AND a.`thidate` <= '$now' AND a.`toborow` 
LIKE 'EX30%' 
GROUP BY a.`hn` 
ORDER BY c.`dx_mc_soldier` ASC, a.`thidate` ASC 
LIMIT 999";

$db->select($sql);
$items = $db->get_items();

$all_booking = count($booking);
?>
<h3>งดเว้นเกณฑ์ทหารตั้งแต่ 31 ต.ค. 59 ถึง ปัจจุบัน ปี60</h3>
<table border="1" bordercolor="#000000" style="border-collapse: collapse">
    <thead>
        <tr>
            <th>#</th>
            <th>วันที่ออกvnทะเบียน</th>
            <th>HN</th>
            <th>ชื่อสกุล</th>
            <th>เลขบัตรประชาชน</th>
            <th>VNทะเบียน</th>
            <th>EX</th>
            <th>VNซักประวัติ</th>
            <th>กฎ</th>
            <th>มีในสมุด</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;

        $no_opd_vn = 0;
        $pass_opd = 0;
        $pass_opd_onbook = 0;
        $data_complete = 0;
        $data_missing = 0;

        foreach ($items as $key => $item) {
            $rule = trim($item['rule']);
            $dx_mc_soldier = trim($item['dx_mc_soldier']);
            $hn = $item['hn'];
            $opd_vn = $item['opd_vn'];

            // ไม่มีการออกVNซักประวัติ
            $bg_color = '';
            if( empty($opd_vn) ){
                ++$no_opd_vn;

            }else if( !empty($opd_vn) AND empty($rule) AND empty($dx_mc_soldier) ){ // มีการลงซักประวัติ แต่กฏกระทรวงและโรคที่ตรวจพบว่าง
                $bg_color = 'bgcolor="#e399ff"'; // ม่วง
                ++$pass_opd;

                if( isset($booking[$hn]) ){
                    $bg_color = 'bgcolor="#ff9999"'; // แดง
                    ++$pass_opd_onbook;
                }

            }else if( !empty($opd_vn) AND !empty($rule) AND !empty($dx_mc_soldier) ) {
                $bg_color = 'bgcolor="#b4ff99"'; // เขียว
                ++$data_complete;

            }else if( !empty($opd_vn) AND empty($rule) AND !empty($dx_mc_soldier) ){
                $bg_color = 'bgcolor="#f4ee42"'; // เหลือง
                ++$data_missing;

            }

            /*
            if( !empty($opd_vn) AND empty($rule) AND empty($dx_mc_soldier) ){
                
                $bg_color = 'bgcolor="#e399f"'; // ม่วง
                ++$pass_opd;

                // ผ่านซักประวัติ และ ไม่มีกฏกระทรวงและโรคที่ตรวจ แต่ดันมีข้อมูลในสมุด
                if( isset($booking[$hn]) ){
                    $bg_color = 'bgcolor="#ff9999"'; // แดง
                    ++$pass_opd_onbook;
                }

            }
            

            // มีข้อมูลครบ
            if( !empty($opd_vn) AND !empty($rule) AND !empty($dx_mc_soldier) ){
                $bg_color = 'bgcolor="#b4ff99"'; // เขียว
                ++$data_complete;
                 
            }else if( !empty($opd_vn) AND empty($rule) AND !empty($dx_mc_soldier) ){ // ลืมใส่กฏกระทรวง
                $bg_color = 'bgcolor="#f4ee42"'; // เหลือง
                ++$data_missing;
            }

            */

            $inbook = false;
            if( isset($booking[$hn]) ){
                $inbook = 'Y';
            }

            ?>
            <tr <?=$bg_color;?>>
                <td><?=$i;?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$hn;?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['idcard'];?></td>
                <td align="right"><?=$item['vn'];?></td>
                <td><?=$item['toborow'];?></td>
                <td align="right"><?=$opd_vn;?></td>
                <td><?=$rule;?></td>
                <td><?=$inbook;?></td>
            </tr>
            <?php

            // นับแล้วจะทำการตัดออก
            if( isset($booking[$hn]) ){
                unset($booking[$hn]);
            }


            $i++;
        }
        ?>
    </tbody>
</table>

<?php
// ถ้าเหลือ
$outoff_booking = count($booking);
if( $outoff_booking > 0 ){

    ?>
    <h3>ไม่ได้ออกEX30</h3>
    <table border="1" bordercolor="#000000" style="border-collapse: collapse">
        <thead>
            <tr>
                <th>วันที่ออกVN</th>
                <th>HN</th>
                <th>ชื่อสกุล</th>
                <th>VN</th>
                <th>EX</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach( $booking AS $hn => $active ){
            $sql = "SELECT `thidate`,`hn`,`ptname`,`vn`,`toborow` 
            FROM `opday` 
            WHERE `hn` = '$hn' 
            AND `thidate` >= '2559-09-01' ";
            $db->select($sql);
            $user_items = $db->get_items();

            foreach ($user_items as $key => $item) {
                ?>
                <tr>
                    <td><?=$item['thidate'];?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['vn'];?></td>
                    <td><?=$item['toborow'];?></td>
                </tr>
                <?php
            }
            
        }

        ?>
        </tbody>
    </table>
    <?php
}

?>

<fieldset>
    <legend>ข้อมูลในระบบ</legend>
    <p><b>ไม่ผ่านการซักประวัติ:</b> <?=$no_opd_vn;?>คน</p>
    <p><b style="background-color: #e399ff;">ผ่านการซักประวัติแต่ไม่มีการบันทึกงดเว้นเกณฑ์ทหาร:</b> <?=( $pass_opd - $pass_opd_onbook );?>คน</p>
    <p><b style="background-color: #ff9999;">ผ่านการซักประวัติแต่ลืมบันทึกงดเว้นเกณฑ์ทหาร:</b> <?=$pass_opd_onbook;?>คน</p>
    <p><b style="background-color: #b4ff99;">บันทึกข้อมูลครบ:</b> <?=$data_complete;?>คน</p>
    <p><b style="background-color: #f4ee42;">ลืมบันทึกกฏกระทรวง:</b> <?=$data_missing;?>คน</p>
</fieldset>

<fieldset>
    <legend>ข้อมูลในสมุด</legend>
    <?php
    if( $outoff_booking > 0 ){
        $all_booking
        ?>
        <p><b>ออกEX30:</b> <?=($all_booking - $outoff_booking);?>คน</p>
        <p><b>ไม่ได้ออกEX30:</b> <?=$outoff_booking;?>คน</p>
        <?php
    }
    ?>
</fieldset>