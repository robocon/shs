<?php 
include_once 'bootstrap.php';
include_once 'includes/JSON.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_REQUEST['action']);
if($action==='search'){
    $hn = sprintf("%s", $_REQUEST['hn']);
    $res = array();
    if(empty($hn)){
        $res = array('status'=>400,'message' => 'ไม่พบ HN');

    }else{

        $last = strtotime("-6 months");
        $date = (date('Y', $last)+543).date('-m-d', $last);
        $q = $dbi->query("SELECT `row_id` AS `id`,`date`,`hn`,`tvn` FROM `phardep` WHERE `hn` = '$hn' AND `date` >= '$date' ");
        $a_rows = $q->num_rows;
        if($a_rows==0){
            $res = array('status'=>400, 'message' => 'ไม่พบรายการ 6เดือนย้อนหลัง' );
        }else{
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = array('status'=>200,'count' => $a_rows,'items' => $items);
        }
    }
    
    $json = new Services_JSON();
    echo $json->encode($res);
    exit;

}elseif ($action==='showDrugrx') {
    
    $id = sprintf("%d", $_REQUEST['id']);
    $res = array();
    if(empty($id)){
        $res = array('status'=>400,'message' => 'ข้อมูลผิดพลาด');
    }else{
        $q = $dbi->query(" SELECT a.*, b.`tradname`
        FROM ( 
            SELECT `row_id` AS `id`,`slcode`,`drugcode`,`amount` FROM `drugrx` WHERE `idno` = '$id' 
        ) AS a 
        LEFT JOIN `druglst` AS b ON b.`drugcode` = a.`drugcode`
        WHERE a.`amount` > 0");
        $a_rows = $q->num_rows;
        if($a_rows>0){
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = array('status'=>200,'count' => $a_rows,'items' => $items);
        }else{
            $res = array('status'=>400,'message' => 'ไม่พบข้อมูล');
        }
    }
    $json = new Services_JSON();
    echo $json->encode($res);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medication Reconciliation</title>
    <style>
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        label{
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="clearfix">
    <table style="width:30%; float:left;">
        <tr>
            <td>
                <p>ตรวจสอบยาเดิมในโรงพยาบาล</p>
                <div>
                    <form action="hndrugcheckv2.php" id="hnSearch" method="post">
                        HN: <input type="text" name="hn" id="hn">
                        <button type="submit">ตรวจสอบ</button>
                    </form>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Visit 6 เดือนล่าสุด
                <div id="findDate"></div>
            </td>
        </tr>
    </table>
    <form action="hndrugcheck_print.php" method="post" id="phardepSearch" target="_blank" style="width:70%; float:right;">
        <table>
            <tr>
                <td>
                    <p>จำนวนรายการยาจากสถานพยาบาลอื่นของผู้ป่วย</p>
                    <input type="text" name="other" id="other"> รายการ
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="checkall" id="checkall">#</th>
                                <th>รายการยา/ความแรง</th>
                                <th>วิธีใช้</th>
                                <th>จำนวน</th>
                            </tr>
                        </thead>
                        <tbody id="showFromSelected"></tbody>
                    </table>
                </td>
            </tr>
        </table>
        <button type="submit">พิมพ์ใบ MR</button>
        <input type="hidden" name="phardep_id" id="phardep_id">
    </form>
</div>
<?php 

$ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0') !== false && strpos($ua, 'rv:11.0') !== false)) {
	?>
    <div id="notify-ie">
        <p>ไมโครซอฟหยุด Support Internet Explorer ตั้งแต่ 15 มิถุนายน 2022 เป็นต้นไป<br>ดาวโหลด/อัพเดท เป็น <a href="https://www.microsoft.com/th-th/edge?r=1">Microsoft Edge</a> ได้แล้ววันนี้</p>
    </div>
    <?php
}
?>
<script type="template/javascript" id="drug_template">
<tr>
    <td><input type="checkbox" class="dItem" name="drug_id[]" id="dId{{drug_id}}" value="{{drug_id}}"></td>
    <td><label for="dId{{drug_id}}">{{item_id}}.{{drug_tradname}}</label></td>
    <td align="center">{{drug_slcode}}</td>
    <td align="right">{{drug_amount}}</td>
</tr>
</script>
<style>
    #notify-ie{
        background-color: #ffff97;
        border: 2px solid #464600;
        padding: 4px;
        text-align: center;
        vertical-align: middle;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
<script>
    
    // เลือก HH
    document.getElementById("hnSearch").onsubmit = function(e){
        e.preventDefault();
        var hn = document.getElementById("hn").value;
        searchPhardep(hn);
        return false;
    }

    // แสดงรายการ Visit
    async function searchPhardep(hn){
        var res = await fetch("hndrugcheckv2.php?action=search&hn="+hn);
        var data = await res.json();
        document.getElementById("showFromSelected").innerHTML = '';
        if(data.status===400){
            document.getElementById("findDate").innerHTML = data.message;
        }else{
            var html = '';
            data.items.forEach(el => {
                html += '<div><input type="radio" name="dateSelect" id="dateSelect'+el.id+'" onclick="findDrugrx(\''+el.id+'\')"><label for="dateSelect'+el.id+'">'+el.date+' VN: '+el.tvn+'</label></div>';
            });
            document.getElementById("findDate").innerHTML = html;
        }
    }

    // คลิกจาก Visit
    async function findDrugrx(id){ 
        
        var res = await fetch("hndrugcheckv2.php?action=showDrugrx&id="+id);
        var data = await res.json();

        var html = '';
        
        var i =1;
        data.items.forEach(el => { 
            var tem = document.getElementById('drug_template').innerHTML;
            // console.log(el);
            tem = tem.replace(/{{item_id}}/g, i, tem);
            tem = tem.replace(/{{drug_id}}/g, el.id, tem);
            tem = tem.replace(/{{drug_tradname}}/g, el.tradname, tem);
            tem = tem.replace(/{{drug_slcode}}/g, el.slcode, tem);
            tem = tem.replace(/{{drug_amount}}/g, el.amount, tem);
            i++;
            html += tem;
        });
        document.getElementById('showFromSelected').innerHTML = html;
        document.getElementById("checkall").checked = false;
        document.getElementById("other").value = '';
        document.getElementById("phardep_id").value = id;
        
    }

    document.getElementById("checkall").onclick = function(){
        var myCheck = this.checked;
        var allItem = document.getElementsByClassName("dItem");
        for (let index = 0; index < allItem.length; index++) {
            const element = allItem[index];
            element.checked = myCheck;
        }
    }

    document.getElementById("phardepSearch").onsubmit = function(e){
        // e.preventDefault();
        var allItem = document.getElementsByClassName("dItem");
        if(allItem.length === 0){
            alert("กรุณาเลือก Visit ที่ต้องการ");
            return false;
        }

        // var checkSelected = false;
        // data = [];
        // for (let index = 0; index < allItem.length; index++) {
        //     if(allItem[index].checked === true){
        //         checkSelected = true;
        //         data.push(allItem[index].value);
        //     }
        // }
        // if(checkSelected===false){
        //     alert("กรุณาเลือกรายการยา");
        //     return false;
        // }
    }

    async function phardepPrint(){
        await fetch('hndrugcheck_print.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
    }
    
</script>
</body>
</html>