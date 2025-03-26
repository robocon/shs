<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$company = $company_code = $date_checkup = $job_date_run = '';
$read_only = false;
if( $id > 0 ){
    $sql = sprintf("SELECT * FROM `chk_company_list` WHERE `id` = '%s' ", $dbi->real_escape_string($id));
    $q = $dbi->query($sql);
    $item = $q->fetch_assoc();

    $name = $item['name'];
    $code = $item['code'];
    $date_checkup = $item['date_checkup'];
    $job_date_run = $item['job_date_run'];
    
    $read_only = 'readonly="readonly"';

    $sqlOpcardchk = sprintf("SELECT `row` FROM `opcardchk` WHERE `part` = '%s' ", $dbi->real_escape_string($code));
    $qOpcardchk = $dbi->query($sqlOpcardchk);
    $user_rows = $qOpcardchk->num_rows;
    $del_txt = 'chk_company.php?action=del&id='.$id;
    if( $user_rows > 0 ){
        // ถ้ายังมี user จะลบไม่ได้
        $del_txt = 'javascript: void(0); alert(\'กรุณาลบรายชื่อผู้ตรวจสุขภาพก่อนลบบริษัท\');';
    }
    
}
?>
<fieldset>
    <legend>เพิ่มบริษัทใหม่</legend>
    <form action="chk_company.php" method="post" id="formAddCompany" onsubmit="formAddCompanySubmit()">
        <table>
            <tr>
                <td valign="top">
                    <table>
                        <tr>
                            <td align="right">ชื่อบริษัท : </td>
                            <td><input type="text" name="company" id="company" value="<?=$name;?>" style="width:200px;"></td>
                        </tr>
                        <tr>
                            <td align="right">รหัสบริษัท : </td>
                            <td>
                                <input type="text" name="company_code" id="company_code" value="<?=$code;?>" <?=$read_only;?> style="width:200px;">
                                <button type="button" id="checkCompany" onclick="onCheckCompany()">🕵 ตรวจสอบ</button>
                                <div id="resCheckCompany"></div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">วันที่ตรวจ : </td>
                            <td>
                                <input type="text" name="date_checkup" id="date_checkup" value="<?=$date_checkup;?>"> 
                                <div style="color: red;"><u>* แสดงผลในใบพิมพ์ผลตรวจสุขภาพประจำปี</u> ตัวอย่างเช่น 5-20 ตุลาคม 2560</div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">เลือกรายงาน : </td>
                            <td>
                                <select name="typeReport" id="typeReport">
                                    <option value="chk_report04.php">ผู้ป่วย walk-in เอง</option>
                                    <option value="chk_report03.php">มีการกำหนด Lab Number เอง</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">รอบปีงบประมาณ : </td>
                            <td>
                                <?php 
                                $year_checkup = get_year_checkup(true);
                                $year_list = range($year_checkup, $year_checkup+1);
                                ?>
                                <select name="yearchk" id="yearchk">
                                    <?php 
                                    foreach ($year_list as $key => $value) {
                                        ?>
                                        <option value="<?=$value;?>"><?=$value;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit">💾 บันทึกข้อมูล</button>&nbsp; 
                                <?php 
                                if( $id > 0 ){
                                    ?><a href="<?=$del_txt;?>" onclick="return confirm('ยืนยันที่จะลบข้อมูล?')">🗑️ ลบข้อมูล</a><?php
                                }
                                ?>
                                <input type="hidden" name="action" value="save">
                                <input type="hidden" name="id" value="<?=$id;?>">
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top" >
                    <?php 
                    $jobStyle = 'display:none;';
                    $jobChecked = '';
                    if(!empty($job_date_run)){
                        $jobStyle = '';
                        $jobChecked = 'checked="checked"';
                    }
                    ?>
                    <input type="checkbox" id="genVn" name="genVn" value="1" <?=$jobChecked;?> onclick="showGenVn()"><label for="genVn">ออก VN อัตโนมัติ</label>
                    
                    <table id="genVnContainer" style="<?=$jobStyle;?>">
                        <tr >
                            <td align="right" valign="top">เลือกวันที่ : </td>
                            <td>
                                <input type="date" name="job_date_run" id="job_date_run" value="<?=$job_date_run;?>">
                                <div>* ระบบจะทำการสร้าง VN ในเวลา 00:05น. ของวันที่ได้เลือกไว้</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</fieldset>