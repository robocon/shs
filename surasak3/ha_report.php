<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานตัวชี้วัด</title>
</head>
<body>
<?php 
include_once 'ha_menu.php';
$page = sprintf("%s", $_REQUEST['page']);

$month_start = sprintf("%s", empty($_POST['month_start']) ? '' : $_POST['month_start'] );
$month_end = sprintf("%s", empty($_POST['month_end']) ? '' : $_POST['month_end'] );

$year_start = sprintf("%s", empty($_POST['year_start']) ? date('Y') : $_POST['year_start'] );
$year_end = sprintf("%s", empty($_POST['year_end']) ? date('Y') : $_POST['year_end'] );

$main_id = sprintf("%s", $_POST['main_id']);


$report_type = (empty($_POST['report_type'])) ? 'month' : $_POST['report_type'];

$style_year = 'style="display:none;"';
$style_month = '';

$checked_year = '';
$checked_month = 'checked="checked"';

if($report_type==='year'){
    $style_year = '';
    $style_month = 'style="display:none;"';

    $checked_year = 'checked="checked"';
    $checked_month = '';
}

?>
<div>
    <h1>รายงานตัวชี้วัด</h1>
</div>
<div>
    <form action="ha_report.php" method="post">
        <table>
            <tr>
                <td align="right">รายงาน: </td>
                <td colspan="3">
                    <input type="radio" name="report_type" id="report_month" value="month" onclick="active_month()" <?=$checked_month;?> > <label for="report_month">ตามเดือน</label>
                    <input type="radio" name="report_type" id="report_year" value="year" onclick="active_year()" <?=$checked_year;?> > <label for="report_year">ตามปี</label>
                </td>
            </tr>
            <tr>
                <td align="right">ตัวชี้วัด:</td>
                <td>
                    <select name="main_id" id="main_id">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                    <?php 
                    // แสดงรายการใน select > option
                    // [ PARENT ]
                    //    1.) [CHILD 1]
                    //    2.) [CHILD 2]
                    //    ...
                    $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' AND `parent` IS NULL ORDER BY `sort` ASC");
                    $allItemList = array();
                    while ($a = $q->fetch_assoc()) {
                        
                        $parent = $a['id'];
                        
                        $q2 = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' AND `parent` = '$parent' ORDER BY `sort` ASC");
                        $child_rows = $q2->num_rows;

                        $allItemList[] = $a;

                        if($child_rows>0){
                            $field_i = 1;
                            while ($b = $q2->fetch_assoc()) {
                                $b['name'] = '&nbsp;&nbsp;'.$field_i.'.) '.$b['name'];
                                $allItemList[] = $b;
                                $field_i++;
                            }
                        }
                    }
                    
                    foreach($allItemList AS $key => $a){

                        $selected = $main_id == $a['id'] ? 'selected="selected"' : '' ;

                        ?>
                        <option value="<?=$a['id'];?>" <?=$selected;?> ><?=$a['name'];?></option>
                        <?php
                    }
                    ?>
                    </select>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="right">ปี:</td>
                <td>
                    <select name="year_start" id="year_start">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                        <?php 
                        $range = array_reverse(range(2019, date('Y')));
                        foreach ($range as $key => $value) { 
                            $selected = $value == $year_start ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$value;?>" <?=$selected;?> ><?=($value+543);?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
                <td align="right" class="display_year" <?=$style_year;?>>ถึงปี: </td>
                <td class="display_year" <?=$style_year;?>>
                    <select name="year_end" id="year_end">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                        <?php 
                        $range = array_reverse(range(2019, date('Y')));
                        foreach ($range as $key => $value) { 
                            $selected = $value == $year_end ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$value;?>" <?=$selected;?> ><?=($value+543);?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr class="display_month" <?=$style_month;?>>
                <td align="right">เดือน:</td>
                <td>
                    <select name="month_start" id="month_start">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                    <?php 
                    foreach ($def_fullm_th as $key => $value) {
                        $selected = $key == $month_start ? 'selected="selected"' : '' ;
                        ?>
                        <option value="<?=$key;?>" <?=$selected;?> ><?=$value;?></option>
                        <?php
                    }
                    ?>
                    </select>
                </td>
                <td align="right">ถึงเดือน:</td>
                <td>
                    <select name="month_end" id="month_end">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                    <?php 
                    foreach ($def_fullm_th as $key => $value) {
                        $selected = $key == $month_end ? 'selected="selected"' : '' ;
                        ?>
                        <option value="<?=$key;?>" <?=$selected;?> ><?=$value;?></option>
                        <?php
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <button type="submit">ค้นหาข้อมูล</button>
                    <input type="hidden" name="page" value="search">
                </td>
            </tr>
        </table>
    </form>
    <script type="text/javascript">
        function active_year(){
            const year_items = document.getElementsByClassName('display_year');
            for (let index = 0; index < year_items.length; index++) {
                const element = year_items[index];
                element.style.display = '';
            }

            const month_items = document.getElementsByClassName('display_month');
            for (let index = 0; index < month_items.length; index++) {
                const element = month_items[index];
                element.style.display = 'none';
            }
            
        }

        function active_month(){
            const year_items = document.getElementsByClassName('display_year');
            for (let index = 0; index < year_items.length; index++) {
                const element = year_items[index];
                element.style.display = 'none';
            }

            const month_items = document.getElementsByClassName('display_month');
            for (let index = 0; index < month_items.length; index++) {
                const element = month_items[index];
                element.style.display = '';
            }
        }
    </script>

<?php 
if ($page==='search') {

    $vertify = true;
    $report_type = sprintf("%s", $_POST['report_type']);

    $range_year = range($year_start, $year_end);
    $range_month = range($month_start, $month_end);
    if(empty($main_id)){
        $msg = 'กรุณาเลือกตัวชี้วัดที่ต้องการ';
        $vertify = false;
    }

    if($report_type==='year'){
        if(empty($year_start) OR empty($year_end)){
            $msg = 'กรุณาตรวจสอบช่วงเวลาให้ถูกต้อง';
            $vertify = false;
        }elseif ($year_start > $year_end) {
            $msg = 'เลือกปีผิดพลาด';
            $vertify = false;
        }
    }else{
        if(empty($month_start) OR empty($month_end)){
            $msg = 'กรุณาเลือกเดือนให้ถูกต้อง';
            $vertify = false;
        }elseif ($month_start > $month_end) {
            $msg = 'เลือกเดือนผิดพลาด';
            $vertify = false;
        }
        
    }

    if($vertify===false){
        
        ?>
        <div>
            <p><b><?=$msg;?></b></p>
        </div>
        <?php
        
    }else{

        // dump("id: ".$main_id);

        // :::: STATEMENT สำหรับแสดงหัวข้อหลักและหัวข้อย่อย ด้านซ้ายมือ ::::
        // START
        $qm = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$main_id'");
        $mainRows = $qm->num_rows;
        $main = $qm->fetch_assoc();
        // dump("row จาก main: ".$mainRows);

        $qSubParent = $dbi->query("SELECT * FROM `indicator_main` WHERE `parent` = '$main_id' ORDER BY `sort`");
        $findChildRows = $qSubParent->num_rows;
        // dump("row จาก parent: ".$findChildRows);
        $field_items = array();

        // ถ้าฟิลด์ใน parent เป็นค่าว่าง และ child มีมากกว่า 0 แสดงว่าเป็น parent
        if($main['parent']===NULL && $findChildRows > 0){
            
            while ($fm = $qSubParent->fetch_assoc()) {

                $fm_main_id = $fm['id'];
                $field_items[$fm_main_id] = array('name'=>$fm['name'], 'parent'=>true);

                $q_field = $dbi->query("SELECT `id`,`name`,`target` FROM `indicator_field` WHERE `main_id` = '$fm_main_id' AND `status` = 'y' ");
                $child_rows = $q_field->num_rows;
                if($child_rows > 0){
                    $field_i = 1;
                    while ($f = $q_field->fetch_assoc()) {
                        $fid = $f['id'];
                        $field_items[$fid] = array(
                            'name'=>'&nbsp;&nbsp;'.$field_i.'.) '.$f['name'], 
                            'target'=>$f['target'],
                            'field_id' => $fid
                        );
                        $field_i++;
                    }
                }
            }

        }else{

            // $field_items : ข้อมูลที่ต้องแสดงแต่ละบรรทัด
            $q_field = $dbi->query("SELECT `id`,`name`,`target` FROM `indicator_field` WHERE `main_id` = '$main_id' AND `status` = 'y' ");
            $field_items = array();
            while ($f = $q_field->fetch_assoc()) {
                $fid = $f['id'];
                $field_items[$fid] = array(
                    'name'=>$f['name'], 
                    'target'=>$f['target'],
                    'field_id' => $fid
                );
            }

        }
        
        // :::: STATEMENT สำหรับแสดงหัวข้อหลักและหัวข้อย่อย ด้านซ้ายมือ ::::
        // END
        ?>
        <div>
            <h1><?=$main['name'];?> <?=$month_txt;?> <?=$year_txt;?></h1>
            <?php 

            /**
             * statement จะถูกแยกออกเป็น 4แบบคือ
             * กรณีที่ต้องแสดงหัวข้อหลัก+หัวข้อย่อย เป็นปี
             * กรณีที่ต้องแสดงหัวข้อหลัก+หัวข้อย่อย เป็นเดือน
             * 
             * เฉพาะหัวข้อย่อย เป็นปี
             * เฉพาะหัวข้อย่อย เป็นเดือน
             */
            // :::: STATEMENT สำหรับแสดงข้อมูล
            if($findChildRows > 0){ 
                
                if ($report_type==='year') { 

                    $sql = "SELECT a.`id` AS `main_id`,b.*,c.`name` FROM 
                    ( SELECT `id` FROM `indicator_main` WHERE `parent` = '$main_id' ) AS a 
                    LEFT JOIN `indicator_data` AS b ON b.`main_id` = a.`id` 
                    LEFT JOIN `indicator_field` AS c ON b.`field_id` = c.`id` 
                    ORDER BY b.`main_id`, b.`year`, b.`field_id`";
                    

                }else{
                    $sql = "SELECT a.`id` AS `main_id`,b.*,c.`name` FROM 
                    ( SELECT `id` FROM `indicator_main` WHERE `parent` = '$main_id' ) AS a 
                    LEFT JOIN ( 
                        SELECT * FROM `indicator_data` WHERE `year` = '$year_start' AND ( `month`>= '$month_start' AND `month`<='$month_end' )
                    ) AS b ON b.`main_id` = a.`id` 
                    LEFT JOIN `indicator_field` AS c ON b.`field_id` = c.`id` 
                    ORDER BY b.`main_id`, b.`year`, b.`field_id`";
                    
                }
            }else{
            
                // ถ้าเลือกรายางานเป็นปี
                if ($report_type==='year') {

                    $sql = "SELECT a.`main_id`,a.`field_id`,a.`value`,a.`year`, b.`name` 
                    FROM ( 

                        SELECT `main_id`,`year`,`field_id`,`value` 
                        FROM `indicator_data` 
                        WHERE `main_id` = '$main_id'
                        AND ( `year` >= '$year_start' AND `year` <= '$year_end' ) 
                        GROUP BY `field_id`,`year`

                    ) AS a RIGHT JOIN ( 

                        SELECT * FROM `indicator_field` WHERE `main_id` = '$main_id' 

                    ) AS b ON a.`field_id` = b.`id` 
                    WHERE b.`status` = 'y' AND ( a.`value` != '' AND  a.`value` IS NOT NULL ) 
                    ORDER BY a.`year`,a.`field_id` ASC ";

                }else{

                    $sql = "SELECT a.`main_id`,a.`field_id`,a.`value`,a.`year`,a.`month`, b.`name` 
                    FROM ( 
                        SELECT * FROM `indicator_data` WHERE `main_id` = '$main_id' AND `year` = '$year_start' AND ( `month`>= '$month_start' AND `month`<='$month_end' )   
                    ) AS a RIGHT JOIN ( 
                        SELECT * FROM `indicator_field` WHERE `main_id` = '$main_id' 
                    ) AS b ON a.`field_id` = b.`id` 
                    WHERE b.`status` = 'y' 
                    ORDER BY a.`year`,a.`month`,a.`field_id` ASC ";

                }

            }

            $q=$dbi->query($sql);
            if ($q->num_rows>0) {

                if ($report_type==='month') {

                    $data_items = array();
                    while ($a=$q->fetch_assoc()) {
                        $field_id = $a['field_id'];
                        $m = $a['month'];

                        $data_items[$field_id][$m] = array(
                            'value' => $a['value'],
                            'name' => $a['name']
                        );
                    }

                    ?>
                    <table class="chk_table">
                        <tr>
                            <th>ตัวชี้วัด</th>
                            <th>เป้า</th>
                            <?php 
                            foreach ($range_month as $key => $value) {
                                $m = sprintf("%02d", $value);
                                ?>
                                <th><?=$def_fullm_th[$m];?></th>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php 
                        foreach ($field_items as $key => $item) {

                            $style = '';
                            if($item['parent']===true){
                                $style = 'font-weight:bold; font-size:24px;';
                            }

                            ?>
                            <tr>
                                <td style="<?=$style;?>"><?=$item['name'];?></td>
                                <?php 
                                if($item['parent']===true){
                                    ?>
                                    <td colspan="<?=count($range_month)+1;?>"></td>
                                    <?php
                                }else{
                                    ?>
                                    <td><?=$item['target'];?></td>
                                    <?php 
                                    foreach ($range_month as $dkey => $dvalue) {
                                        $m = sprintf("%02d", $dvalue);
                                        $value = $data_items[$key][$m]['value'];
                                        
                                        $data_style = '';
                                        if(empty($value)){
                                            $value = 'N/A';
                                            $data_style = 'background-color: #c5c5c5;';
                                        }
                                        ?>
                                        <td style="<?=$data_style;?>" ><?=$value;?></td>
                                        <?php
                                    }
                                    
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                }elseif ($report_type==='year') {

                    $data_items = array();
                    while ($a=$q->fetch_assoc()) {
                        $year = $a['year'];
                        $field_id = $a['field_id'];
                        $data_items[$year][$field_id] = array(
                            'value' => $a['value'],
                            'title' => $a['name']
                        );
                    }
                    
                    ?>
                    <table class="chk_table">
                        <tr>
                            <th>ตัวชี้วัด</th>
                            <th>เป้า</th>
                            <?php 
                            foreach ($range_year as $key => $value) {
                                ?>
                                <th><?=($value+543);?></th>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php 
                        foreach ($field_items as $key => $v) { 
                            
                            $name = $v['name'];
                            $target = $v['target'];
                            $field_id = $v['field_id'];

                            $style = '';
                            if($v['parent']===true){
                                $style = 'font-weight:bold; font-size:24px;';
                            }

                            ?>
                            <tr>
                                <td style="<?=$style;?>"><?=$name;?></td>
                                <?php 
                                if($v['parent']===true){
                                    ?>
                                    <td colspan="<?=count($range_year)+1;?>"></td>
                                    <?php
                                }else{
                                    ?>
                                    <td style="text-align:center;"><?=$target;?></td>
                                    <?php 
                                    
                                    foreach ($range_year as $year_key => $year_value) {
                                        
                                        $real_value = $data_items[$year_value][$field_id]['value'];
                                        $data_style = 'text-align:right;';
                                        if($real_value==null){
                                            $real_value = 'N/A';
                                            $data_style = 'background-color: #c5c5c5;';
                                        }

                                        ?>
                                        <td style="<?=$data_style;?>" ><?=$real_value;?></td>
                                        <?php
                                    }
                                    
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    <?php 

                }

            }else{
                ?>
                <p>ยังไม่พบการลงข้อมูล <?=$main['name'];?></p>
                <?php
            }
        ?>
        </div>
        <?php
    }
}
?>
</div>
</body>
</html>