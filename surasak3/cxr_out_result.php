<?php

include 'bootstrap.php';
$db = Mysql::load();

// $db->exec("SET NAMES TIS620");

$action = input('action');
if ( $action == 'upload' ) {

    $part = input_post('part');
    $officer = $_SESSION['sOfficer'];

    $db->select("SELECT `yearchk` FROM `chk_company_list` WHERE `code` = '$part' ");
    $company = $db->get_item();
    $yearchk = substr($company['yearchk'], 2, 2);

    $file = $_FILES['cxr_lists'];
    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);
   
    $msg = 'บันทึกข้อมูลเรียบร้อย';

    foreach($items as $key => $item){
		
		if(!empty($item)){

            list($number, $hn, $name, $surname, $cxr1, $cxr2, $cxr3 , $cxr_detail) = explode(',', $item);

            $cxr1 = trim($cxr1);
            $cxr2 = trim($cxr2);
            $cxr3 = trim($cxr3);

            $sql = "SELECT *,CONCAT(`name`,' ',`surname`) AS `ptname` 
            FROM `opcardchk` 
            WHERE `HN` = '$hn' 
            AND `part` = '$part' ";
            $db->select($sql);
            if( $db->get_rows() > 0 ){

                $user = $db->get_item();
                // $ptname = $user['ptname'];
                $ptname = $name.' '.$surname;

                $hn = trim($hn);
                
                $cxr = '';
                if( !empty($cxr1) ){
                    $cxr = 'ปกติ';
                }elseif( !empty($cxr2) ){
                    $cxr = 'ผิดปกติเล็กน้อย';
                }elseif( !empty($cxr3) ){
                    $cxr = 'ผิดปกติควรพบแพทย์';
                }

                $cxr_detail = htmlspecialchars($cxr_detail, ENT_QUOTES);
                $cxr_detail = trim(preg_replace('/\s+/',' ',$cxr_detail));


                $sql = "SELECT `id` FROM `chk_cxr` WHERE `hn` = '$hn' AND `part` = '$part' ";
                $db->select($sql);
                $chk_cxr_row = $db->get_rows();
                if( $chk_cxr_row > 0 ){

                    // update 
                    $out_items = $db->get_item();
                    $row_id = $out_items['id'];

                    $sql = "UPDATE `chk_cxr` SET 
                    `ptname`='$ptname',
                    `cxr`='$cxr', 
                    `detail`='$cxr_detail', 
                    `editor`='$officer', 
                    `edit_date`=NOW()
                    WHERE (`id`='$row_id');";
                    $save = $db->update($sql);
                    if( $save !== true ){
                        $msg = errorMsg('update', $save['id']);
                    }
                    
                }elseif ( $chk_cxr_row == 0 ) {

                    // insert 
                    $sql = "INSERT INTO `chk_cxr` (
                        `id`, `hn`, `ptname`, `cxr`, `detail`, `officer`, `date`, `editor`, `edit_date`, `part`, `year_chk` 
                    ) VALUES (
                        NULL, '$hn', '$ptname', '$cxr', '$cxr_detail', '$officer', NOW(), '$officer', NOW(), '$part', '$yearchk'
                    );";
                    $save = $db->insert($sql);
                    if( $save !== true ){
                        $msg = errorMsg('insert', $save['id']);
                    }

                } // insert or update from chk_cxr


            } // if from opcardchk

		}
		
    }

    redirect('cxr_out_result.php', $msg);
    exit;
}

include 'chk_menu.php';

?>
<form action="cxr_out_result.php" method="post" enctype="multipart/form-data">
    <div>
        <fieldset style="padding: 20px;">
            <legend>ฟอร์มการบันทึกข้อมูล</legend>
            <div>
            <?php 
                $db->select("SELECT `name`,`code` FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` DESC");
                $items = $db->get_items();
                ?>
                เลือกบริษัทที่จะบันทึกข้อมูล : 
                <select name="part" id="">
                    <option value="">-- รายชื่อบริษัท --</option>
                    <?php
                    foreach ($items as $key => $item) {
                        ?><option value="<?=$item['code'];?>"><?=$item['name'].' ('.$item['code'].')';?></option><?php
                    }
                    ?>
                </select>
            </div>
            <div>
                ไฟล์: <input type="file" name="cxr_lists">
            </div>
            <div>
                <button type="submit">บันทึกข้อมูล</button>
                <input type="hidden" name="action" value="upload">
            </div>
        </fieldset>
    </div>
</form>
<br>
<div>
    <fieldset>
        <legend>ตัวอย่างการจัดวางรูปแบบสำหรับโปรแกรม Excel</legend>
        <div>
            <p><b>รูปแบบการจัดวางข้อมูลในไฟล์ CSV(Comma Dilimited)</b></p>
        </div>
        <div>
            <table class="chk_table" width="100%">
                <tr>
                    <td width="5%">ลำดับ</td>
                    <td width="5%">HN</td>
                    <td width="8%">ชื่อ</td>
                    <td width="8%">สกุล</td>
                    <td width="10%">ปกติ</td>
                    <td width="10%">ผิดปกติ<br>เล็กน้อย</td>
                    <td width="10%">ผิดปกติ<br>ควรพบแพทย์</td>
                    <td>รายละเอียด</td>
                </tr>
            </table>
        </div>
        <div>
            <p><b>ตัวอย่าง</b></p>
        </div>
        <div>
            <table class="chk_table" width="100%">
                <tr>
                    <td width="5%">1</td>
                    <td width="5%">48-7954</td>
                    <td width="8%">ทดสอบ</td>
                    <td width="8%">ทดลอง</td>
                    <td width="10%" align="center">/</td>
                    <td width="10%" align="center">&nbsp;</td>
                    <td width="10%" align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>62-2599</td>
                    <td>ทดสอบ2</td>
                    <td>ทดลอง2</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">/</td>
                    <td align="center">&nbsp;</td>
                    <td>รายละเอียด ผิดปกติเล็กน้อย</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>62-2563</td>
                    <td>ทดสอบ3</td>
                    <td>ทดลอง3</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">/</td>
                    <td>รายละเอียด ผิดปกติควรพบแพทย์</td>
                </tr>
            </table>
        </div>
        <div>
            <p><b>การบันทึกไฟล์เป็น CSV</b></p>
        </div>
        <div>
            <img src="images/save-as-csv.png" alt="">
        </div>
    </fieldset>
</div>