<?php 

include 'bootstrap.php';

$db = Mysql::load();

$page = input('page');
$action = input('action');

if ( $action == 'save' ) {

    $new_date = input_post('new_date');
    $ddrugrx_id = input_post('ddrugrx_id');
    $ddrugrx_date = input_post('ddrugrx_date');
    $dphardep_id = input_post('dphardep_id');
    $dphardep_date = input_post('dphardep_date');
    $hn = input_post('hn');

    $msg = "บันทึกข้อมูลเรียบร้อย";
    
    // ค.ศ. เป็น พ.ศ.
    $new_date = ad_to_bc($new_date);

    $sql = "UPDATE `ddrugrx` SET `date`='$new_date' WHERE `row_id`='$ddrugrx_id';";
    $db->exec($sql);

    $sql = "UPDATE `dphardep` SET `date`='$new_date' WHERE `row_id`='$dphardep_id';";
    $db->exec($sql);

    redirect('edit_appoint_inj.php', $msg);
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้ไขฉีดยากรณีมาไม่ตรงนัด</title>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <link type="text/css" href="epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="epoch_classes.js"></script>
    <style>
    body, button{
        font-family: "TH Sarabun New", "TH SarabunPSK";
        font-size: 16pt;
    }
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
        font-size: 16pt;
    }
    </style>
    <div>
        <h3>แก้ไขฉีดยากรณีมาไม่ตรงนัด</h3>
    </div>
    <fieldset>
        <legend>ค้นหาการนัดจาก HN</legend>
        <form action="edit_appoint_inj.php" method="post">
            <div>
                HN : <input type="text" name="hn" id="">
            </div>
            <div>
                วันที่นัด : <input type="text" name="dateInj" id="dateInj">
            </div>
            <div>
            <b>เลือกข้อมูลตามใบนัดฉีดยาเดิม</b><br>
            <img src="images/demoInj.png" alt="" style="width:600px;">
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search_hn">
            </div>
        </form>
    </fieldset>
    <script type="text/javascript">
        var popup1;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('dateInj'),false);
        };
    </script>


<?php
if ( $page == 'search_hn' ) {

    $hn = input_post('hn');
    $dateInj = input_post('dateInj');

    $dateInj = ad_to_bc($dateInj);

    $sql = "SELECT a.`hn`,a.`ptname`,a.`row_id` AS `dphardep_id`, a.`date` AS `dphardep_date`, 
    b.`row_id` AS `ddrugrx_id`, b.`date` AS `ddrugrx_date`, b.`drugcode`, b.`tradname` 
    FROM `dphardep` AS a 
    LEFT JOIN `ddrugrx` AS b ON b.`idno` = a.`row_id` 
    WHERE a.`hn` = '$hn' 
    AND a.`date` LIKE '$dateInj%' 
    AND a.`dr_cancle` IS NULL ";
    $db->select($sql);
    if ( $db->get_rows() == 0 ) {
        echo "ไม่พบข้อมูลการนัด";
        exit;
    }

    $items = $db->get_items();

    ?>
    <fieldset>
        <legend>เลือกวันที่</legend>
        <table class="chk_table">
            <tr>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>นัดมาวันที่</th>
                <th>ยาฉีดในวัน</th>
                <th>แก้ไข</th>
            </tr>
        <?php
        foreach ($items as $key => $item) { 

            $idno = $item['row_id'];
            $hn = $item['hn'];
            $ddrugrx_date = $item['ddrugrx_date'];

            list($dateInj, $timeInj) = explode(' ',$item['dphardep_date']);
            list($y,$m,$d) = explode('-',$dateInj);
            $mTh = $def_fullm_th[$m];
            $thDate = "$d $mTh $y";
            
            $sql = "SELECT `row_id` 
            FROM `drugrx` 
            WHERE `datedr` = '$ddrugrx_date' 
            AND `hn` = '$hn' 
            AND `drugcode` LIKE '0%' 
            AND `status` = 'y' 
            HAVING COUNT(`row_id`) > 0";
            $db->select($sql);

            $title = '';
            $color = '';
            $onclick = '';
            if( $db->get_rows() > 0 ){
                $color = 'style="background-color: yellow;"';
                $onclick = 'onclick="return notify();"';

            }
            
            ?>
            <tr <?=$color;?> valign="top">
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$thDate;?></td>
                <td><?=$item['tradname'];?></td>
                <td><a href="edit_appoint_inj.php?ddrugrx_id=<?=$item['ddrugrx_id'];?>&dphardep_id=<?=$item['dphardep_id'];?>&hn=<?=$hn;?>&page=edit_form" <?=$onclick;?>>แก้ไข</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </fieldset>
    <script>
    function notify(){
        var c=confirm('รายการนี้มีการตัดยาไปเรียบร้อยแล้ว ท่านยืนยันที่จะเปลี่ยนข้อมูลวันที่ฉีดยาหรือไม่?');
        return c;
    }
    </script>
    <?php
}elseif ( $page == 'edit_form' ) {

    
    $hn = input_get('hn');
    $dphardep_id = input_get('dphardep_id');
    $ddrugrx_id = input_get('ddrugrx_id');

    list($y,$m,$d) = explode('-',$item['appdate']);
    $mTh = $def_fullm_th[$m];

    $sql = "SELECT a.`hn`,a.`ptname`,a.`row_id` AS `dphardep_id`, a.`date` AS `dphardep_date`, 
    b.`row_id` AS `ddrugrx_id`, b.`date` AS `ddrugrx_date`, b.`drugcode`, b.`tradname` 
    FROM `dphardep` AS a 
    LEFT JOIN `ddrugrx` AS b ON b.`idno` = '$dphardep_id' 
    WHERE a.`hn` = '$hn' 
    AND a.`row_id` LIKE '$dphardep_id%' 
    AND a.`dr_cancle` IS NULL ";
    $db->select($sql);
    $item = $db->get_item();

    $ddrugrx_date = $item['ddrugrx_date'];
    $sql = "SELECT `row_id` 
    FROM `drugrx` 
    WHERE `datedr` = '$ddrugrx_date' 
    AND `hn` = '$hn' 
    AND `drugcode` LIKE '0%' 
    AND `status` = 'y' 
    HAVING COUNT(`row_id`) > 0";
    $db->select($sql);
    $c = false;
    if( $db->get_rows() > 0 ){
        $alert = true;
    }

    
    ?>
    <link type="text/css" href="epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="epoch_classes.js"></script>
    <style>
    .shsTitle{
        padding: 6px 0 12px;
    }
    .shsTitle p{
        padding: 0;
        margin: 0;
    }
    .shsTitle .shsHeader{
        border-bottom: 1px solid #8b8b8b;
        margin-bottom: 6px;
    }
    </style>
    <fieldset>
        <legend>แก้ไขวันนัดฉีดยา</legend>
        <div class="shsTitle">
            <div class="shsHeader">ข้อมูลเบื้องต้น</div>
            <div>
                <p>
                    <b>HN : </b> <?=$item['hn'];?> 
                    <b>ชื่อ-สกุล : </b> <?=$item['ptname'];?> 
                </p>
                <p>
                    <b>ยาฉีด : </b> <?=$item['tradname'];?>
                    <b>วันนัดเดิม : <?=$item['dphardep_date'];?></b>
                </p>
            </div>
        </div>
        <form action="edit_appoint_inj.php" method="post" onsubmit="return notifyConfirm();">
            <div>
                เลื่อนวันนัดใหม่ : <input type="text" name="new_date" id="new_date" value="">
            </div>
            <div>

                <button type="submit">บันทึก</button>
                <?php 
                if ($alert === true) {
                    ?><div style="padding: 6px;border: 2px solid #b5af00;background-color: #fffc9d;"><b>แจ้งเตือน</b> รายการนี้มีการตัดยาไปเรียบร้อยแล้ว</div><?php
                }
                ?>
                <input type="hidden" name="action" value="save">

                <input type="hidden" name="ddrugrx_id" value="<?=$item['ddrugrx_id'];?>">
                <input type="hidden" name="ddrugrx_date" value="<?=$item['ddrugrx_date'];?>">

                <input type="hidden" name="dphardep_id" value="<?=$item['dphardep_id'];?>">
                <input type="hidden" name="dphardep_date" value="<?=$item['dphardep_date'];?>">

                <input type="hidden" name="hn" value="<?=$item['hn'];?>">
            </div>
        </form>
    </fieldset>
    <script type="text/javascript">
        var popup1;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('new_date'),false);
        };

        function notifyConfirm(){
            return confirm('ยืนยันที่จะบันทึกข้อมูล');
        }
    </script>
    <?php 

}
?>
</body>
</html>