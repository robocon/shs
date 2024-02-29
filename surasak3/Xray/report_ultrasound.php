<?php 
include '../bootstrap.php';
include '../includes/JSON.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");



$action = sprintf("%s", ($_REQUEST['action']) ? $_REQUEST['action'] : '' );
if($action==='search'){

    $ptright = sprintf("%s", $_REQUEST['ptright']);
    $date = sprintf("%s", $_REQUEST['date']);
    list($y, $m) = explode('-', $date);

    $json = new Services_JSON();

    $sql = "SELECT `date`,`hn`,`ptname`,`code`,`detail`,`ptright` 
    FROM `patdata` 
    WHERE `date` LIKE '$date%' 
    AND `code` IN ('43764','43763','43762','43760','43752','43644','43614','43611','43512','43510','43440','43423','43251','43250','43222','43212','43044','43043','43042','43041','43040','43007','43502','43004','43005') 
    AND `ptright` LIKE '$ptright%' ";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        $items = array();
        $ptrightName = '';
        while ($a = $q->fetch_assoc()) {
            $items[] = $a;
            $ptrightName = $a['ptright'];
        }

        $title = 'รายงานประจำเดือน '.$def_fullm_th[$m].' '.$y.' ('.count($items).' ราย)';

        $res = array('status'=>200, 'data'=>$items, 'rows'=>count($items), 'title'=>$title);
    }else{
        $res = array('status'=>400, 'error'=>'ไม่มีข้อมูลจ้า');
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
    <title>รายงาน Ultrasound</title>
</head>
<body>
    <?php 
    include 'xray_menu.php';
    ?>
    <style>
        body{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }
        #ptRightMenu{
            float: left;
            width: 30%;
        }
        #showDetails{
            float: left;
            width: 70%;
        }
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table a{
            text-decoration: none;
        }
        .chk_table a:hover{
            text-decoration: underline;
        }
        .chk_table th{
            background-color: #e3e3e3;
        }
        .chk_table tr:hover{
            background-color: #C1E1C1;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }
    </style>
    <h1>รายงาน Ultrasound แยกตามสิทธิการรักษา</h1>
    <div>
        <form action="report_ultrasound.php" method="post">
            <div>
                <label for="month">เดือน</label>
                <?=getMonthList('month',($_POST['month'] ? $_POST['month'] : date('m') ));?>
                <label for="year">ปี</label>
                <?=getYearList('year',true,($_POST['year'] ? $_POST['year'] : date('Y') ));?>
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search">
            </div>
        </form>
    </div>
    <div>
        <div id="ptRightMenu">
    <?php 
    $page = sprintf("%s", ($_POST['page'] ? $_POST['page'] : '' ));
    if($page == 'search'){
        
        $thDate = ($_POST['year']+543).'-'.$_POST['month'];

        // labcare detail ที่ขึ้นต้นด้วย US
        $sql = "SELECT `ptright`, COUNT(`row_id`) AS `rows` FROM `patdata` 
        WHERE `date` LIKE '$thDate%' 
        AND `code` IN ('43764','43763','43762','43760','43752','43644','43614','43611','43512','43510','43440','43423','43251','43250','43222','43212','43044','43043','43042','43041','43040','43007','43502','43004','43005') 
        GROUP BY `ptright`";
        $q = $dbi->query($sql);
        if($q->num_rows > 0){
            ?>
            <table class="chk_table">
                <tr>
                    <th>สิทธิ</th>
                    <th>จำนวน</th>
                </tr>
            <?php
            while ($a = $q->fetch_assoc()) {

                $ptrightCode = substr($a['ptright'], 0, 3);
                ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" onclick="showDetail('<?=$ptrightCode;?>','<?=$thDate;?>')"><?=$a['ptright'];?></a>
                    </td>
                    <td><?=$a['rows'];?></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }else{
            ?><p>ไม่พบข้อมูล</p><?php
        }
    }
    ?>
        </div>
        <div id="showDetails"></div>
    </div>
    <script>
        async function showDetail(ptright,date){

            let url = 'ptright='+encodeURIComponent(ptright);
            url += '&date='+encodeURIComponent(date);
            const response = await fetch('report_ultrasound.php?action=search&'+url);
            const res = await response.json();
            
            if(res.status==200){ 
                let html = '<p><b>'+res.title+'</b></p>';
                html += '<table width="100%" class="chk_table">';
                html += '<tr><th>วันที่</th><th>HN</th><th>ชื่อสกุล</th><th>รายละเอียด</th></tr>';
                for (let index = 0; index < res.data.length; index++) {
                    const el = res.data[index];
                    html += '<tr><td>'+el.date+'</td><td>'+el.hn+'</td><td>'+el.ptname+'</td><td>('+el.code+') '+el.detail+'</td></tr>';
                }
                html += '</table>';
                document.getElementById('showDetails').innerHTML = html;
            }else{

            }

        }
    </script>
</body>
</html>