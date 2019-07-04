<?php

include 'bootstrap.php';
$db = Mysql::load();

$action = input('action');
if ( $action === 'upload' ) {

    $part = input_post('part');
    $officer = $_SESSION['sOfficer'];

    $db->select("SELECT `yearchk` FROM `chk_company_list` WHERE `code` = '$part' ");
    $company = $db->get_item();
    $yearchk = substr($company['yearchk'], 2, 2);

    $file = $_FILES['cxr_lists'];
    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);
   
    foreach($items as $key => $item){
		
		if(!empty($item)){

            list($hn, $cxr, $cxr_detail) = explode(',', $item);

            $sql = "SELECT *,CONCAT(`name`,' ',`surname`) AS `ptname` FROM `opcardchk` WHERE `HN` = '$hn' AND `part` = '$part' ";
            $db->select($sql);
            if( $db->get_rows() > 0 ){

                $user = $db->get_item();
                $ptname = $user['ptname'];

                $hn = trim($hn);
                $cxr = trim($cxr);

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
            <table class="chk_table">
                <tr>
                    <th>HN</th>
                    <th>ผล</th>
                    <th>รายละเอียด</th>
                </tr>
            </table>
        </div>
        <div>
            <p><b>ตัวอย่าง</b></p>
        </div>
        <div>
            <table class="chk_table">
                <tr>
                    <td>48-7954</td>
                    <td>ปกติ</td>
                    <td></td>
                </tr>
                <tr>
                    <td>62-2599</td>
                    <td>ผิดปกติเล็กน้อย</td>
                    <td>รายละเอียด</td>
                </tr>
                <tr>
                    <td>62-2563</td>
                    <td>ผิดปกติควรพบแพทย์</td>
                    <td>รายละเอียด</td>
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
<php