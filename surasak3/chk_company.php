<?php

include 'bootstrap.php';
include 'includes/JSON.php';

$action = input('action');
$db = Mysql::load();

if( $action == 'save' ) {
    
    $company = input_post('company');
    $id = input_post('id');
    $company_code = input_post('company_code');
    $date_checkup = input_post('date_checkup');
    $yearchk = sprintf("%d", $_POST['yearchk']);
    $typeReport = $_REQUEST['typeReport'];

    $msg = 'บันทึกข้อมูลเรียบร้อย';

    if( empty($company) OR empty($company_code) ){
        $msg = 'กรุณาใส่ข้อมูล ชื่อบริษัท และ รหัสบริษัทให้ถูกต้อง';
    }else{

        if( $id > 0 ){
            $sql = "UPDATE `chk_company_list`
            SET
            `name` = '$company', 
            `code` = '$company_code', 
            `date_checkup` = '$date_checkup', 
            `yearchk` = '$yearchk' 
            WHERE `id` = '$id';";
            $save = $db->update($sql);

            if( $save !== true ){
                $msg = errorMsg('save', $save['id']);
            }

        }else{

            $sql = "SELECT `id` FROM `chk_company_list` WHERE `code` = '$company_code'";
            $db->select($sql);
            $chk_row = $db->get_rows();
            if( $chk_row == 0 ){
                $sql = "INSERT INTO `chk_company_list` ( `id`,`name`,`code`,`date_checkup`,`yearchk`,`status`,`report` ) 
                VALUES (
                    NULL,'$company','$company_code','$date_checkup','$yearchk','1','$typeReport'
                );";
                $save = $db->insert($sql);

                if( $save !== true ){
                    $msg = errorMsg('save', $save['id']);
                }
            }else{
                $msg = "รหัสบริษัทซ้ำซ้อนไม่สามารถบันทึกข้อมูลได้";
            }
            
        }

    }

    redirect('chk_company.php', $msg);
    exit;

}elseif ($action == 'del') {
    
    if(!authen()) die('กรุณา Loing เพื่อเข้าสู่ระบบอีกครั้ง');

    $id = input_get('id');
    $del = $db->exec("DELETE FROM `chk_company_list` WHERE `id` = '$id' ");
    $msg = 'ดำเนินการเรียบร้อย';
    if( $del !== true ){
        $msg = errorMsg('delete', $del['id']);
    }
    redirect('chk_company.php', $msg);
    exit;
}elseif ($action==='findWithYear') {

    $year = sprintf("%s", $_GET['year'])+543;
    $json = new Services_JSON();
    $items = array();
    $db->select("SELECT `id`,`name`,`code` FROM `chk_company_list` WHERE `yearchk` = '$year' AND `status` = '1' ORDER BY `id` DESC ");
    $itemCount = $db->get_rows();
    if($itemCount > 0){
        $items = $db->get_items();
        $res = array(
            'count' => $itemCount,
            'data' => $items,
            'status' => 200
        );
    }else{
        $res = array(
            'count' => $itemCount,
            'data' => $items,
            'status' => 400
        );
    }

    echo $json->encode($res);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการข้อมูล ตรวจสุขภาพ</title>
</head>
<body>
<?php

include 'chk_menu.php';

$id = input_get('id', 0);
$company = $company_code = $date_checkup = '';
$read_only = false;
if( $id > 0 ){
    $sql = "SELECT * FROM `chk_company_list` WHERE `id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    $name = $item['name'];
    $code = $item['code'];
    $date_checkup = $item['date_checkup'];
    
    $read_only = 'readonly="readonly"';

    $db->select("SELECT `row` FROM `opcardchk` WHERE `part` = '$code' ");
    $user_rows = $db->get_rows();
    $del_txt = 'chk_company.php?action=del&id='.$id;
    if( $user_rows > 0 ){
        // ถ้ายังมี user จะลบไม่ได้
        $del_txt = 'javascript: void(0); alert(\'กรุณาลบรายชื่อผู้ตรวจสุขภาพก่อนลบบริษัท\');';
    }
    
}
?>
<style>
ol > li {
    margin-bottom: 6px;
}
</style>
<fieldset>
    <legend>เพิ่มบริษัทใหม่</legend>
    <form action="chk_company.php" method="post">
        <table>
            <tr>
                <td align="right">ชื่อบริษัท : </td>
                <td><input type="text" name="company" value="<?=$name;?>" style="width: 40%; "></td>
            </tr>
            <tr>
                <td align="right">รหัสบริษัท : </td>
                <td><input type="text" name="company_code" value="<?=$code;?>" <?=$read_only;?>></td>
            </tr>
            <tr>
                <td align="right">วันที่ตรวจ : </td>
                <td>
                    <input type="text" name="date_checkup" value="<?=$date_checkup;?>"> 
                    <span style="color: red;"><u>* ใช้ในการแสดงผลในใบพิมพ์ผลตรวจสุขภาพประจำปี</u> ตัวอย่างเช่น 5-20 ตุลาคม 2560</span>
                </td>
            </tr>
            <tr>
                <td align="right">เลือกรายงาน : </td>
                <td>
                    <select name="typeReport" id="">
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
            <?php 
            if( $id > 0 ){
                ?>
                <tr>
                    <td colspan="2">
                        <a href="<?=$del_txt;?>">ลบข้อมูลบริษัท</a>
                    </td>
                </tr>
                <?php 
            }
            ?>
            <tr>
                <td colspan="2">
                    <button type="submit">บันทึกข้อมูล</button>
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="id" value="<?=$id;?>">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<br>
<fieldset>
    <legend>ค้นหาตามปีงบประมาณ</legend>
    <form action="chk_company.php" method="post">
        <div> เลือกปี : 
            <?php 
            $year_selected = input_post('year_selected', date('Y') );
            $year_range = range('2018',get_year_checkup(true, true)+1);
            getYearList('year_selected', true, $year_selected, $year_range,false, 'getCompany');
            ?>
        </div>
        <div>
            <span>เลือกบริษัท : </span>
            <?php 
            $db->select("SELECT `id`,`name`,`code` FROM `chk_company_list` WHERE `yearchk` = '".($year_selected+543)."' AND `status` = '1' ORDER BY `id` DESC ");
            if($db->get_rows()>0){
                ?>
                <span id="selectYearResponse">
                    <select name="companySelected" id="companySelected">
                        <option value="">-- แสดงทั้งหมด --</option>
                        <?php 
                        $companyItems = $db->get_items();
                        foreach ($companyItems as $companyItem) {
                            ?><option value="<?=$companyItem['id'];?>"><?=$companyItem['code'];?></option><?php
                        }
                        ?>
                    </select>
                </span>
                <?php
            }
            ?>
        </div>
        <div>
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="views" value="search">
        </div>
    </form>
</fieldset>
<script>
    function getCompany(){
        let yearSelected = document.getElementById('year_selected').value;
        getComapnyAsync(yearSelected).then((response)=>{
            let res = JSON.parse(response);
            if(res.count>0){
                
                document.getElementById('companySelected').innerHTML = '';

                let companyTxt = '<option value="">-- แสดงทั้งหมด --</option>';
                for( let i=0; i<res.count; i++){
                    const com = res.data[i];
                    companyTxt += '<option value="'+com.id+'">'+com.code+'</option>';
                }

                document.getElementById('companySelected').innerHTML = companyTxt;
            }
        });
    }
    async function getComapnyAsync(year){
        const response = await fetch('chk_company.php?action=findWithYear&year='+year);
        if (!response.ok) {
        }
        const body = await response.text();
        return body;
    }
</script>
<?php 
$views = input_post('views');
if ( $views == 'search' ) {
?>
<div>
    <?php 
    
    $year_selected += 543; 

    $companySelected = sprintf($_POST['companySelected']);
    $whereCompany = '';
    if(!empty($companySelected)){
        $whereCompany = "AND `id` = '$companySelected' ";
    }

    $sql = "SELECT * FROM `chk_company_list` 
    WHERE `yearchk` = '$year_selected' $whereCompany AND `status` = '1' 
    ORDER BY `id` ASC";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <h3>รายชื่อบริษัท</h3>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th style="width: 15%;">ชื่อบริษัท</th>
            <th style="width: 20%;">รหัสเชื่อมข้อมูล</th>
            <th>ช่วงเวลาที่ตรวจ</th>
            <th>ปีงบ</th>
            <th>ลงผล/พิมพ์ผล</th>
            <th>พิมพ์ผล ปกส.</th>
        </tr>
        <?php
        $i = 1;

        // เปิดให้ใช้งานในเมนู manual_expense เพื่อเพิ่มค่าใช้จ่าย
        // เทศบาลเมืองพิชัย 67
        $expense_list = array('เทศบาลนครลำปาง 67 Day 1','เทศบาลนครลำปาง 67 Day 2');

        foreach ($items as $key => $item) {

            $companyCode = $item['code']; 
            $db->select("SELECT COUNT(`HN`) AS `rows` FROM `opcardchk` WHERE `part` = '$companyCode' ");
            $op = $db->get_item();
            $userRows = $op['rows'];

            $report = ( !empty($item['report']) ) ? $item['report'].'?camp='.$item['code'] : 'javascript:void(0);' ;

            $reportAllFile = (!empty($item['report_all'])) ? $item['report_all'] : 'chk_report_all.php' ;

            $reportAll = $reportAllFile.'?camp='.$item['code'];
            ?>
            <tr style="vertical-align:top;">
                <td><?=$i;?></td>
                <td><a href="chk_show_user.php?part=<?=urlencode($item['code']);?>" target="_blank" title="ดูรายชื่อทั้งหมด"><?=$item['name'];?></a></td>
                <td><?=$item['code'];?> <b>(<?=$userRows;?>ราย)</b><br><a href="chk_company.php?id=<?=$item['id'];?>">แก้ไขชื่อบริษัท</a></td>
                <td><?=$item['date_checkup'];?></td>
                <td align="center"><?=$item['yearchk'];?></td>
                <td style="vertical-align: top;">
                    <ol class="itemMenu">
                        <li><a href="out_result.php?part=<?=$item['code'];?>" target="_blank">ลงข้อมูลซักประวัติ</a></li>
                        <li><a href="<?=$report;?>" target="_blank">ผลตรวจรายบุคคล</a></li>
                        <li><a href="<?=$reportAll;?>" target="_blank">สรุปผลตรวจ</a></li>
                        <!-- <li><a href="chk_all_lab.php?part=<?=$item['code'];?>" target="_blank">ผล Lab ทั้งหมด</a></li> -->
                        <li><a href="chk_lab_sticker.php?part=<?=$item['code'];?>" target="_blank">พิมพ์สติกเกอร์ LAB</a></li>
                        <!-- <li><a href="chk_report_all_money.php?camp=<?=$item['code'];?>" target="_blank">ทดสอบ ค่าใช้จ่ายจากรายการแลป (ตรวจนอกรพ.)</a></li> -->
                        <li>
                            <a href="chk_print_xray.php?id=<?=$item['id'];?>" target="_blank">พิมพ์ใบนำทาง X-Ray</a>
                        </li>
                        <!-- <li>
                            <a href="chk_load_lab.php?id=<?=$item['id'];?>" target="_blank">พิมพ์ผลแลป METAMP</a>
                        </li> -->
                        <?php 
                        if(in_array($item['code'], $expense_list)===true){
                            ?>
                            <a href="manual_expense.php?part=<?=$item['code'];?>" target="_blank" style="border: 1px solid #1e8958; background-color: #0a3622; border-radius: 4px; padding: 0 2px; color: #ffffff;">&#128073; บันทึกค่าใช้จ่าย อปท.</a>
                            <?php
                        }
                        ?>
                    </ol>
                </td>
                <td style="vertical-align: top;">
                    <ol class="itemMenu">
                        <li><a href="chk_cross_sso.php?camp=<?=$item['code'];?>" target="_blank">สรุปผลรวม</a></li>
                        <li><a href="chk_print_all_sso.php?part=<?=rawurlencode($item['code']);?>" target="_blank">พิมพ์ผลตามแบบฟอร์มประกันสังคม</a></li>
                        <li><a href="chk_money_sso.php?part=<?=$item['code'];?>" target="_blank">พิมพ์ค่าใช้จ่าย</a></li>
                    </ol>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php
    ?>
</div>
<?php
}
?>
</body>
</html>