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
        $sql = "SELECT `row_id` AS `id`,`date`,`hn`,`tvn` 
        FROM `phardep` 
        WHERE `hn` = '$hn' 
        AND `date` >= '$date' 
        AND ( `price` > 0 AND `borrow` IS NULL ) 
        AND ( `an` = '' OR `an` IS NULL) ORDER BY `date` DESC ";
        $q = $dbi->query($sql);
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
    
    $hn = sprintf("%s", $_REQUEST['hn']);
    $last = strtotime("-6 months");
    $date = (date('Y', $last)+543).date('-m-d', $last);
    $res = array();
    if(empty($hn)){
        $res = array('status'=>400,'message' => 'ข้อมูลผิดพลาด');
    }else{

        $q_pt = $dbi->query("SELECT `hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`idcard`,`ptright`,`sex` FROM `opcard` WHERE `hn` = '$hn' ");
        $pt = $q_pt->fetch_assoc();

        $sql = " SELECT a.*, b.`tradname`
        FROM ( 
            SELECT `row_id` AS `id`,SUBSTRING(`date`,1,10) AS `date`,`slcode`,`drugcode`,`amount` FROM `drugrx` WHERE `hn` = '$hn' AND `date` >= '$date'
        ) AS a 
        LEFT JOIN `druglst` AS b ON b.`drugcode` = a.`drugcode`
        WHERE a.`amount` > 0 
        ORDER BY `date` DESC";
        $q = $dbi->query($sql);
        $a_rows = $q->num_rows;
        if($a_rows>0){
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = array('status'=>200,'count' => $a_rows,'items' => $items,'user'=>$pt);
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
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
        h1{
            font-size:38px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        label{
            cursor: pointer;
        }
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }
        #drugrxContainer tbody>tr:hover,
        #drugrxContainer tbody>tr>td>button:hover{
            background-color: #ffff97;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="clearfix">
    <div style="width:50%; float:left;">
        <div>
            <table>
                <tr>
                    <td>
                        <h1>ตรวจสอบยาเดิมในโรงพยาบาล</h1>
                        <div>
                            <form action="hndrugcheckv2.php" id="hnSearch" method="post">
                                <b>HN:</b> <input type="text" name="hn" id="hn">
                                <button type="submit">ตรวจสอบ</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b style="color: orange;">* Visit 6 เดือนล่าสุด</b>
                    </td>
                </tr>
            </table>
        </div>
        <div id="findDate">
            <div>
                <p><b>ชื่อ-สกุล: </b><span id="pt_name"></span> <b>เลขบัตร: </b><span id="pt_idcard"></span> <b>เพศ: </b><span id="pt_sex"></span></p>
                <p><b>HN: </b><span id="pt_hn"></span> <b>สิทธิการรักษา: </b><span id="pt_ptright"></span> </p>
            </div>
            <table id="drugrxContainer" class="chk_table" width="80%">
                <thead>
                    <tr style="background-color: #04AA6D; color: white;">
                        <th></th>
                        <th>วันที่</th>
                        <th>ชื่อยา</th>
                        <th>วิธีใช้</th>
                        <th>จำนวน</th>
                    </tr>
                </thead>
                <tbody id="showDrugrx"></tbody>
            </table>
        </div>
    </div>
    
    <div style="position:relative; width:50%; float:left;">
        <form action="hndrugcheck_print.php" method="post" id="phardepSearch" target="_blank">
            <table width="100%">
                <tr>
                    <td>
                        <fieldset>
                            <legend><b>จำนวนรายการยาจากสถานพยาบาลอื่นของผู้ป่วย</b></legend>
                            <input type="text" name="other" id="other"> รายการ
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        <div id="itemListContain">
                            <p><b>รายการยาในโรงพยาบาล</b></p>
                            <table class="chk_table" width="80%">
                                <thead>
                                    <tr style="background-color: #04AA6D; color: white;">
                                        <th>รายการยา/ความแรง</th>
                                        <th>วิธีใช้</th>
                                        <th>จำนวน</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="showFromSelected"></tbody>
                            </table>
                            <button type="submit">พิมพ์ใบ MR</button>
                            <input type="hidden" name="phardep_id" id="phardep_id">
                        </div>
                        
                    </td>
                </tr>
            </table>
            
        </form>
    </div>
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
    <td><input type="hidden" class="dItem" name="drug_id[]" id="dId{{drug_id}}" value="{{drug_id}}">{{drug_tradname}}</td>
    <td align="left">{{drug_slcode}}</td>
    <td align="right">{{drug_amount}}</td>
    <td align="right"><a href="javascript:void(0);" onclick="this.closest('tr').remove()">[ยกเลิก]</a></td>
</tr>
</script>
<script type="template/javascript" id="drug_template1">
<tr>
    <td><button type="button" onclick="preSendForm('{{drug_id}}','{{drug_tradname}}','{{drug_slcode}}','{{drug_amount}}')">เลือกข้อมูล</button></td>
    <td>{{drug_date}}</td>
    <td>{{drug_tradname}}</td>
    <td align="left">{{drug_slcode}}</td>
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
<script type="text/javascript">
    
    // เลือก HH
    document.getElementById("hnSearch").onsubmit = function(e){
        e.preventDefault();
        var hn = document.getElementById("hn").value;
        searchPhardep(hn).then((data)=>{
            document.getElementById("showFromSelected").innerHTML = '';
            if(data.status===400){
                document.getElementById("showDrugrx").innerHTML = data.message;
            }else{

                document.getElementById('pt_name').innerHTML = data.user.ptname;
                document.getElementById('pt_idcard').innerHTML = data.user.idcard;
                document.getElementById('pt_sex').innerHTML = data.user.sex;
                document.getElementById('pt_hn').innerHTML = data.user.hn;
                document.getElementById('pt_ptright').innerHTML = data.user.ptright;

                // document.getElementById('').innerHTML = xxx;

                var html = '';
                var i =1;
                data.items.forEach(el => { 
                    var tem = document.getElementById('drug_template1').innerHTML;
                    
                    tem = tem.replace(/{{item_id}}/g, i, tem);
                    tem = tem.replace(/{{drug_id}}/g, el.id, tem);
                    tem = tem.replace(/{{drug_date}}/g, el.date, tem);
                    tem = tem.replace(/{{drug_tradname}}/g, el.tradname, tem);
                    tem = tem.replace(/{{drug_slcode}}/g, el.slcode, tem);
                    tem = tem.replace(/{{drug_amount}}/g, el.amount, tem);
                    i++;
                    html += tem;
                });

                document.getElementById("showDrugrx").innerHTML = html;
            }
        });
        return false;
    }

    // แสดงรายการ Visit
    async function searchPhardep(hn){
        var res = await fetch("hndrugcheckv2.php?action=showDrugrx&hn="+hn);
        var data = await res.json();
        
        return data;
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

    /**
     * @important REMOVE
     */
    // document.getElementById("checkall").onclick = function(){
    //     var myCheck = this.checked;
    //     var allItem = document.getElementsByClassName("dItem");
    //     for (let index = 0; index < allItem.length; index++) {
    //         const element = allItem[index];
    //         element.checked = myCheck;
    //     }
    // }

    function preSendForm(drug_id,trade_name,slcode,amount){
        console.log(drug_id);
        console.log(trade_name);
        console.log(slcode);

        var tem = document.getElementById('drug_template').innerHTML;
        tem = tem.replace(/{{drug_id}}/g, drug_id, tem);
        tem = tem.replace(/{{drug_tradname}}/g, trade_name, tem);
        tem = tem.replace(/{{drug_slcode}}/g, slcode, tem);
        tem = tem.replace(/{{drug_amount}}/g, amount, tem);

        document.getElementById('showFromSelected').innerHTML += tem;
    }

    document.getElementById("phardepSearch").onsubmit = function(e){
        var allItem = document.getElementsByClassName("dItem");
        if(allItem.length === 0){
            alert("กรุณาเลือก Visit ที่ต้องการ");
            return false;
        }
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

    window.onscroll = function(){ 

        var ilc =document.getElementById('phardepSearch');

        // window.pageYOffset ค่า Y ตอน Scroll เม้าส์ลง
        // window.innerHeight ขนาดหน้าจอ
        if(window.pageYOffset > 127){

            ilc.style.position = 'fixed';
            ilc.style.width = '-webkit-fill-available';
            ilc.style.top = '0';

        }else{
            ilc.style.position = 'relative';
            ilc.style.width = 'auto';
        }
    };

    
</script>
</body>
</html>