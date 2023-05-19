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

?>
<div>
    <h1>รายงานตัวชี้วัด</h1>
</div>
<div>
    <form action="ha_report.php" method="post">
        <table>
            <tr>
                <td align="right">ตัวชี้วัด:</td>
                <td>
                    <select name="main_id" id="main_id">
                        <option value="" style="text-align: center;">---- เลือกข้อมูล ----</option>
                    <?php 
                    $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' ");
                    while ($a = $q->fetch_assoc()) {

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
                <td align="right">ตั้งแต่ปี:</td>
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
                <td align="right">ถึงปี: </td>
                <td>
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
            <tr>
                <td align="right">ตั้งแต่เดือน:</td>
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

<?php 
if ($page==='search') {

    /**
     * เดี๋ยวต้องปรับให้ค้นหาแค่ ปี / ปี+เดือน ได้
     */
    if(empty($main_id)){
        
        ?>
        <div>
            <p><b>กรุณาเลือกตัวชี้วัดที่ต้องการ</b></p>
        </div>
        <?php
        
    }else{

        $qm = $dbi->query("SELECT * FROM `indicator_main` WHERE `id` = '$main_id'");
        $main = $qm->fetch_assoc();

        $q_field = $dbi->query("SELECT `id`,`name` FROM `indicator_field` WHERE `main_id` = '$main_id' AND `status` = 'y' ");
        $field_items = array();
        while ($f = $q_field->fetch_assoc()) {
            $fid = $f['id'];
            $field_items[$fid] = $f['name'];
        }

        $range_year = range($year_start, $year_end);
        $range_month = range($month_start, $month_end);

        $where = "";
        if(count($range_year) == 1){ 

            $where .= " AND `year` = '$year_start' ";
            if($month_start != $month_end){
                $where .= " AND ( `month`>= '$month_start' AND `month`<='$month_end' ) ";

            }else{
                $where .= " AND `month` = '$month_start' ";

            }

        }elseif ($range_year > 1) { 

            if(empty($month_end)){

                $where .= " AND `month` = '' AND ( `year` >= '$year_start' AND `year` <= '$year_end' ) ";

            }else{
                $where .= " AND ( 
                    ( `year` >= '$year_start' AND `month` >= '$month_start' ) 
                    AND 
                    ( `year` <= '$year_end' AND `month` <= '$month_end' ) 
                ) ";
            }
            
        }
        
        ?>
        <div>
            <h1><?=$main['name'];?> <?=$month_txt;?> <?=$year_txt;?></h1>
            <?php 
            $sql = "SELECT a.`main_id`,a.`field_id`,a.`value`,a.`year`,a.`month`, b.`name` 
            FROM ( 
                SELECT * FROM `indicator_data` WHERE `main_id` = '$main_id' $where  
            ) AS a RIGHT JOIN ( 
                SELECT * FROM `indicator_field` WHERE `main_id` = '$main_id' 
            ) AS b ON a.`field_id` = b.`id` 
            WHERE b.`status` = 'y' 
            ORDER BY a.`year`,a.`month`,a.`field_id` ASC ";
            $q=$dbi->query($sql);
            if ($q->num_rows>0) {

                if(count($range_year) == 1){ 

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
                        foreach ($field_items as $key => $value) {
                            ?>
                            <tr>
                                <td><?=$value;?></td>
                                <?php 
                                foreach ($range_month as $dkey => $dvalue) {
                                    $m = sprintf("%02d", $dvalue);

                                    ?>
                                    <td><?=$data_items[$key][$m]['value'];?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php

                }elseif ($range_year > 1) { 

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
                            <?php 
                            foreach ($data_items as $key => $value) {
                                ?>
                                <th><?=$key;?></th>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php 
                        foreach ($field_items as $key => $v) {
                            ?>
                            <tr>
                                <td><?=$v['value'];?></td>
                                <?php 
                                foreach ($data_items as $fkey => $fv) {
                                    $real_value = $fv[$key]['value'];
                                    ?>
                                    <td><?=$real_value;?></td>
                                    <?php
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