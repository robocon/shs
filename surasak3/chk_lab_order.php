<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

if( $action == false ){
    include 'chk_menu.php';
    ?>

    <h3>รายการตรวจ Lab</h3>
    <form action="chk_lab_order.php" method="post" enctype="multipart/form-data">
        <div>
            ไฟล์นำเข้า : <input type="file" name="file">
            <div>
                <span style="color: red; font-size: 14px;">
                <b><u>คำแนะนำ และข้อควรระวัง</u></b><br>
                - กรุณาตรวจสอบข้อมูลก่อนนำเข้า<br>
                - ระบบรองรับเฉพาะไฟล์ .csv<br>
                </span>
            </div>
        </div>
        <div>
            <button type="submit">นำเข้า</button>
            <input type="hidden" name="action" value="import">
        </div>
        <div>
            <p><b>รูปแบบข้อมูลก่อนนำเข้าสู่ระบบ</b></p>
            <table class="chk_table">
                <tr>
                    <td>Lab Number</td>
                    <td>HN</td>
                    <td>ชื่อ-สกุล</td>
                    <td>เพศ</td>
                    <td>วันเกิด( LIS รองรับเป็นปี ค.ศ. )</td>
                    <td>รายการตรวจ</td>
                </tr>
            </table>
            <br>
            <div>
                <table class="chk_table" style="font-size: 13px;">
                    <tr>
                        <th colspan="2" align="center">คำอธิบาย</th>
                    </tr>
                    <tr>
                        <td>Labnumber</td>
                        <td>รูปแบบ ปี(สองหลัก)เดือนวัน ตามด้วยรหัส lab เช่น 180524301 โดยที่ <br>18 คือปี <br>05 คือเดือน <br>24 คือวัน <br>301 คือรหัสlabเรียงตามคน</td>
                    </tr>
                    <tr>
                        <td>HN</td>
                        <td>รหัสผู้เข้ารับบริการ</td>
                    </tr>
                    <tr>
                        <td>ชื่อ-สกุล</td>
                        <td>รูปแบบ คำนำหน้าชื่อชื่อ สกุล เช่น นายคำ บุญมี</td>
                    </tr>
                    <tr>
                        <td>เพศ</td>
                        <td>M : ผู้ชาย, F : ผู้หญิง</td>
                    </tr>
                    <tr>
                        <td>วันเกิด</td>
                        <td>ใช้รูปแบบ ปี-เดือน-วัน เช่น  1985-12-25 เป็นต้น</td>
                    </tr>
                    <tr>
                        <td>รายการตรวจ</td>
                        <td>รหัสรายการตรวจคั่นด้วย Comma(,) เช่น CBC,UA,BUN เป็นต้น</td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <div>
        <div><b>ตัวอย่างการจัดข้อมูล</b></div>
        <img src="images/sso-import-lab.PNG" alt="">
    </div>
    <?php

} else if ( $action === 'import' ) {

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    
    // @todo
    // - check condition

    if( $content !== false ){

        $items = explode("\r\n", $content);
        
        $i = 0;
        foreach ( $items as $key => $item ) {
            
            $msg = 'บันทึกข้อมูลเสร็จเรียบร้อย';

            if( $i > 0 && !empty($item) ){
                
                list($labnumber, $hn, $ptname, $sex, $dob, $year, $lab_lists) = explode(',', $item, 7);

                $clinicalinfo = "ตรวจสุขภาพประจำปี$year";

                $orderhead_sql = "INSERT INTO `orderhead` ( 
                    `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, 
                    `patientname`, `sex`, `dob`, `sourcecode`, `sourcename`, 
                    `room`, `cliniciancode`, `clinicianname`, `priority`, `clinicalinfo` 
                ) VALUES ( 
                    '', NOW(), '$labnumber', '$hn', 'OPD', 
                    '$ptname', '$sex', '$dob', '', '', 
                    '','', 'MD022 (ไม่ทราบแพทย์)', 'R', '$clinicalinfo'
                );";
                $insert = $db->insert($orderhead_sql);
                if( $insert !== true ){
                    $msg = errorMsg('delete', $insert['id']);
                }

                $lab_lists = str_replace('"', '', $lab_lists);
                $lab_items = explode(',', $lab_lists);
                foreach( $lab_items as $lab_key => $lab_item ){

                    $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                    FROM `labcare` 
                    WHERE `code` = '$lab_item' 
                    LIMIT 1 ";
                    $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                    $num = mysql_num_rows($q);
                    if( $num > 0 ){
                        list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                    
                        $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                            `labnumber` , `labcode`, `labcode1` , `labname` 
                        ) VALUES ( 
                            '$labnumber', '$code', '$oldcode', '$detail'
                        );";
                        $insert = $db->insert($orderdetail_sql);
                        if( $insert !== true ){
                            $msg .= errorMsg('delete', $insert['id']);
                        }
                    }
                    

                }

            } 

            $i++;
        }

    }else{
        $msg = 'กรุณาใส่ข้อมูลให้ถูกต้อง';
    }

    redirect('chk_lab_order.php', $msg);
    exit;

}


